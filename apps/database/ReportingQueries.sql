/*chart1*/
SELECT 
	tenant_id, 
	DATE_FORMAT(submitted_at, '%Y') AS `year`, 
	DATE_FORMAT(submitted_at, '%m') AS `month`, 
	COUNT(id) AS respondents
FROM 
	respondents
WHERE 
	tenant_id = 1
GROUP BY 
	tenant_id, `year`, `month`
ORDER BY 
	tenant_id, `year`, `month`
LIMIT 2
        
/*chart2*/ 
SELECT 
	tenant_id, DATE_FORMAT(submitted_at, '%Y') AS `year`, DATE_FORMAT(submitted_at, '%m') AS `month`, AVG(answers.value) AS IKM
FROM 
	respondents
	JOIN answers 
	ON respondents.id = answers.respondent_id
WHERE 
	tenant_id = 1
GROUP BY 
	tenant_id, `year`, `month`
ORDER BY 
	tenant_id, `year`, `month`
LIMIT 2

/*chart3*/
SELECT 
	tenants.id, 
	divisions.id AS division_id, 
	DATE_FORMAT(respondents.submitted_at, '%Y') AS `year`, 
	DATE_FORMAT(respondents.submitted_at, '%m') AS `month`,
	COUNT(respondents.id) AS respondents
FROM 
	tenants
	JOIN divisions
	ON divisions.tenant_id = tenants.id	
        JOIN respondents 
        ON respondents.division_id = divisions.id
WHERE 
	tenants.id = 1
GROUP BY 
	tenants.id,
	division_id,
	`year`, 
	`month`
