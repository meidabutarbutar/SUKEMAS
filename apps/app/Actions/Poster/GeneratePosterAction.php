<?php

namespace App\Actions\Poster;

use App\Models\Tenant;
use Exception;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class GeneratePosterAction
{
    protected ?Tenant $tenant = null;

    protected ?string $template = '/template/poster/poster-template.jpg';

    protected string $subdir = 'poster';

    public function tenant(Tenant $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function template(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    public function subdir(string $subdir): static
    {
        $this->subdir = $subdir;

        return $this;
    }

    public function handle(Tenant $tenant = null, string $template = null): string
    {
        if ($tenant) {
            $this->tenant($tenant);
        }

        if (!$this->tenant) {
            throw new Exception('No valid Tenant.');
        }

        if ($template) {
            $this->template($template);
        }

        $qrCodePath = $this->tenant->getQRCodeFilePath('l');

        if (!$qrCodePath) {
            throw new Exception("No QRCode for {$this->tenant->token}.");
        }

        $posterPath = Storage::disk('public')
            ->path("/{$this->subdir}/{$this->tenant->token}.jpg");

        logger()->info('Generating Poster', [
            'tenant' => $this->tenant->id,
            'qrCodePath' => $qrCodePath,
            'posterPath' => $posterPath,
            'template' => $this->template,
        ]);

        // open an image file
        $poster = Image::make(Storage::path($this->template));

        // insert the QRCode
        $poster->insert(
            $qrCodePath,
            'bottom-right',
            250,
            600
        );

        $title = $this->tenant->name;

        $poster->text($title, 180, 140, function ($font) {
            $font->file(Storage::path("font/play/play-bold.ttf"));
            $font->size(56);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });

        $address = "{$this->tenant->province->name}, {$this->tenant->regency->name}";

        $poster->text($address, 180, 210, function ($font) {
            $font->file(Storage::path("font/play/play.ttf"));
            $font->size(46);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });

        // save poster
        $poster->save($posterPath);

        return $posterPath;
    }
}
