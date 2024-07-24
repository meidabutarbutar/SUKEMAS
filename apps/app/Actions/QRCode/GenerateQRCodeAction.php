<?php

namespace App\Actions\QRCode;

use App\Models\Tenant;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GenerateQRCodeAction
{
    protected ?Tenant $tenant = null;

    protected ?QROptions $options = null;

    protected string $route = 'public-report';

    protected string $subdir = 'qrcode';

    protected array $sizeVariants = [
        '120',
        '480',
    ];

    protected function defaultOptions(): QROptions
    {
        return new QROptions([
            'version'             => 7,
            'outputType'          => QROutputInterface::GDIMAGE_JPG,
            'eccLevel'            => EccLevel::H,
            'scale'               => 10,
        ]);
    }

    public function tenant(Tenant $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Using a medium error-correction capability, 15%.
     * See: https://support.scanova.io/hc/en-us/articles/900005736826-What-is-QR-Code-Error-Correction-
     */
    public function options(array|QROptions $options): static
    {
        if (is_array($options)) {
            $options = new QROptions($options);
        }

        $this->options = $options;

        return $this;
    }

    public function route(string $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function subdir(string $subdir): static
    {
        $this->subdir = $subdir;

        return $this;
    }

    public function handle(Tenant $tenant = null): string
    {
        if ($tenant) {
            $this->tenant($tenant);
        }

        if (!$this->tenant) {
            throw new Exception('No valid Tenant.');
        }

        $url = route($this->route, ['tenant' => $this->tenant]);

        $qrFilePath = Storage::disk('public')
            ->path("/{$this->subdir}/{$this->tenant->token}.jpg");

        $qr = new QRCode($this->options ?? $this->defaultOptions());

        $qr->render($url, $qrFilePath);

        logger()->info('Generating QRCode', [
            'tenant' => $this->tenant->id,
            'url' => $url,
            'path' => $qrFilePath,
        ]);

        $this->resize($qrFilePath);

        return $qrFilePath;
    }

    protected function resize(string $original): void
    {
        // open an image file
        $img = Image::make($original);

        foreach ($this->tenant->getQRCodeSizes() as $name => $size) {
            // resizing
            $img->resize($size, $size);

            $qrFilePath = Storage::disk('public')
                ->path("/{$this->subdir}/{$this->tenant->token}-{$name}.jpg");

            // save image in desired format
            $img->save($qrFilePath);
        }
    }
}
