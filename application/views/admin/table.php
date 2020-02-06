<?php


    require 'vendor/autoload.php';


    use Google\Spreadsheet\DefaultServiceRequest;
    use Google\Spreadsheet\ServiceRequestFactory;

    putenv('GOOGLE_APPLICATION_CREDENTIALS=my_secret2.json');
    $client = new Google_Client;
    try {

        $client->useApplicationDefaultCredentials();
        $client->setApplicationName("Something to do with my representatives");
        $client->setScopes(['https://www.googleapis.com/auth/drive', 'https://spreadsheets.google.com/feeds']);
        if ($client->isAccessTokenExpired()) {
            $client->refreshTokenWithAssertion();
        }

        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];
        ServiceRequestFactory::setInstance(
            new DefaultServiceRequest($accessToken)
        );
///название таблицы в тайтле
        $spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
            ->getSpreadsheetFeed()
            ->getByTitle('Table');

        $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
        $worksheet = $worksheets[0];

        $listFeed = $worksheet->getListFeed();
        foreach ($vars as $var) {
            $listFeed->insert([
                'name' => $var['name'],
                'surname' => $var['surname'],
                'age' => $var['age']
            ]);
        }

    } catch (Exception $e) {
        echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode();
    }
