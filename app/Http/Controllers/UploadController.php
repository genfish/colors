<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller {
	private $image_ext = ['jpg', 'jpeg'];

	public function upload(Request $request)
	{
		$response = array(
			'status'	=> 'ko',
			'html'		=> ''
		);

		$max_size = (int)ini_get('upload_max_filesize') * 1000;
		$all_ext = implode(',', $this->image_ext);

		$this->validate($request, [
			'file' => 'required|file|mimes:' . $all_ext . '|max:' . $max_size
		]);

		$response['status'] = 'ok';
		$file = $request->file('file');
		$image = imagecreatefromjpeg($file);

		$rTotal = 0;
		$gTotal = 0;
		$bTotal = 0;

		$total = 0;

		for ($x = 0; $x < imagesx($image); $x++)
		{
			for ($y = 0; $y < imagesy($image); $y++)
			{
				$rgb = imagecolorat($image, $x, $y);

				$r   = ($rgb >> 16) & 0xFF;
				$g   = ($rgb >> 8) & 0xFF;
				$b   = $rgb & 0xFF;

				$rTotal += $r;
				$gTotal += $g;
				$bTotal += $b;

				$total++;
			}
		}

		$rAverage = round($rTotal/$total);
		$gAverage = round($gTotal/$total);
		$bAverage = round($bTotal/$total);

		$rgb = array($rAverage, $gAverage, $bAverage);

		$html = '<h3>Color predominant:</h3> <div class="block" style="background-color: rgb(' . $rAverage . ', ' . $gAverage . ', ' . $bAverage . ')"></div>';

		$colors = array(
			array("name" => 'Aqua', "rgb" => array(0, 255, 255) ),
			array("name" => 'Black', "rgb" => array(0, 0, 0) ),
			array("name" => 'Blue', "rgb" => array(0, 0, 255) ),
			array("name" => 'Fuchsia', "rgb" => array(255, 0, 255) ),
			array("name" => 'Gray', "rgb" => array(128, 128, 128) ),
			array("name" => 'Green', "rgb" => array(0, 128, 0) ),
			array("name" => 'Lime', "rgb" => array(0, 255, 0) ),
			array("name" => 'Maroon', "rgb" => array(128, 0, 0) ),
			array("name" => 'Navy', "rgb" => array(0, 0, 128) ),
			array("name" => 'Olive', "rgb" => array(128, 128, 0) ),
			array("name" => 'Purple', "rgb" => array(128, 0, 128) ),
			array("name" => 'Red', "rgb" => array(255, 0, 0) ),
			array("name" => 'Silver', "rgb" => array(192, 192, 192) ),
			array("name" => 'Teal', "rgb" => array(0, 128, 128) ),
			array("name" => 'White', "rgb" => array(255, 255, 255) ),
			array("name" => 'Yellow', "rgb" => array(255, 255, 0) )
		);

		$color_elegit = null;
		$distancia = 0;

		foreach($colors as $i => $color)
		{
			$nova_distancia = abs($rgb[0] - $color['rgb'][0]) + abs($rgb[1] - $color['rgb'][1]) + abs($rgb[2] - $color['rgb'][2]);
			$html .= '<p>La distància amb el color ' . $color['name'] . ' és de: ' . $nova_distancia . '</p>';

			if ($nova_distancia < $distancia or $distancia == 0)
			{
				$distancia = $nova_distancia;
				$color_elegit = $colors[$i];
			}
		}
		imagedestroy($image);

		$html .= '<p>El color més pròxim és: ' . $color_elegit['name'] . '</p>';

		$response['html'] = $html;

		return response()->json($response); 
	}
}
