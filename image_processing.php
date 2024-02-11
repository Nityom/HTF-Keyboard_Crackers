<?php

require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;

$client = new ImageAnnotatorClient();

// Annotate an image, detecting faces.
$annotation = $client->annotateImage(
    fopen('/data/photos/family_photo.jpg', 'r'),
    [Type::FACE_DETECTION]
);

// Determine if the detected faces have headwear.
foreach ($annotation->getFaceAnnotations() as $faceAnnotation) {
    $likelihood = Likelihood::name($faceAnnotation->getHeadwearLikelihood());
    echo "Likelihood of headwear: $likelihood" . PHP_EOL;
}

?>