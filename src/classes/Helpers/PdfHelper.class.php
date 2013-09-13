<?php

	define('FPDF_FONTPATH', PATH_VENDORS.'FPDF/font');
	GlobalVar::me()->import('FPDF');
	
	final class PdfHelper extends Singleton
	{
		const PORTRAIT	= 'p';
		const LANDSCAPE	= 'l';

		const A3			= 'A3';
		const A4			= 'A4';
		const A5		= 'A5';
		const LETTER		= 'Letter';
		const LEGAL		= 'Legal';

		const UNIT		= 'mm';

		/**
		 * @var FPDF
		 */
		private $pdf	= null;

		/**
		 * @var Realty
		 */
		private $realty	= null;

		public static function me()
		{
			return parent::getInstance(__CLASS__);
		}

		public function make(Realty $realty, $return = false)
		{
			$this->realty = $realty;

			$top = 0;
			$top = $this->drawHeader($top);
			$top = $this->drawTitle($top);
			$top = $this->drawGallery($top);
			$top = $this->drawDescription($top);
			
			$this->getPdf()->Output('realty.pdf', $return ? 'S' : 'I');

			return $this;
		}

		private function drawHeader($top = 0)
		{
			$pdf = $this->getPdf();

			$pdf->SetFillColor(0xF6, 0xF6, 0xF6);

			$pdf->Rect(0, $top, 210, $top + 20, 'F');
			$pdf->SetLineWidth(1);
			$pdf->SetDrawColor(0xDD, 0xDD, 0xDD);
			$pdf->Line(0, $top + 20, 210, $top + 20);

			$pdf->Image(PATH_IMG.'logo2.png', 20, $top + 5, 0, 0, 'png');

			$pdf->SetTextColor(0, 0xB, 0x5E);
			$pdf->SetFont('Helvetica', 'I', 17);
			$pdf->Text(35, $top + 10, 'E S P E R I A');

			$pdf->SetTextColor(0, 0x88, 0xCC);
			$pdf->SetFont('Helvetica', '', 11);
			$pdf->Text(35, $top + 15, 'Group of Companies');

			$pdf->SetTextColor(0, 0xB, 0x5E);
			$pdf->Text(120, $top + 9, 'Telephone: +357 25366144, +357 25369209');
			$pdf->Text(128.5, $top + 13, 'Email: info@esperiaestates.com');
			$pdf->Text(130, $top + 17,	'Web: http://www.cyprus-realty.com');

			return $top + 20;
		}

		private function drawTitle($top = 0)
		{
			$pdf = $this->getPdf();
			
			$title = ucfirst($this->realty->getRealtyType()->getName())
				.' in '.$this->realty->getCity()->getName()
				.' to '.i18nHelper::detokenize($this->realty->getOfferType()->getName());
			
			$pdf->SetTextColor(0x44, 0x44, 0x44);
			$pdf->SetFont('Times', 'B', 20);
			$pdf->Text(20, $top + 15, $title);

			return $top + 15;
		}

		private function drawGallery($top)
		{
			$pdf = $this->getPdf();
			$preview = $this->realty->getPreview();

			$top	+= 5;
			$gap	= 2;
			$margin = 20;
			$width	= 210 - $margin * 2;

			$info = $pdf->Image($preview->getPath(), $margin, $top, $width, 0, $preview->getType()->getExtension());

			$pictures = $this->realty->
				getPictures()->
				setCriteria(
					Criteria::create()->
						add(Expression::notEq('id', $preview->getId()))->
						setLimit(2)
				)->
				getList();

			$top += $info['h'] + $gap;;

			if (count($pictures) == 2) {
				$pdf->Image($pictures[0]->getPath(), $margin, $top, ($width - $gap) / 2, 50, $pictures[0]->getType()->getExtension());
				$pdf->Image($pictures[1]->getPath(), $margin + ($width - $gap) / 2 + $gap, $top, ($width - $gap) / 2, 50, $pictures[1]->getType()->getExtension());
			}

			return $top + 50;
		}

		private function drawDescription($top = 0)
		{
			$top += 10;
			$descTop = $top;

			$text = strip_tags($this->realty->getText(), 'p br');
			$text = preg_replace('/<p[^>]*>/', '   ', $text);
			$text = preg_replace('/<\/p>/', "\n", $text);
			$text = preg_replace('/<br[^>]*>/', "\n", $text);

			$pdf = $this->getPdf();
			$list = $this->realty->getFeaturesByGroup(FeatureTypeGroup::general());
			ksort($list);
			$pdf->SetFont('Helvetica', '', 10);
			
			foreach ($list as $typeId => $feature) {
				$pdf->SetTextColor(0, 0x88, 0xCC);
				$pdf->Text(20, $top, $feature->getType()->getName());

				$pdf->SetTextColor(0x44, 0x44, 0x44);
				$pdf->Text(
					50,
					$top,
					$feature->getValue().' '
					.htmlspecialchars_decode(strip_tags($feature->getType()->getUnit()->getSign()))
				);
				$top += 5;
			}

			$top += 5;

			// Indoor & Outdoor features
			if (empty($text))
				$top = $descTop;
			
			foreach (array(FeatureTypeGroup::indoor(), FeatureTypeGroup::outdoor()) as $group) {
				if ($list = $this->realty->getFeaturesByGroup($group)) {
					$pdf->SetFont('Times', '', 10);
					$pdf->SetTextColor(0, 0x88, 0xCC);

					$pdf->Text(
						empty($text) ? 110 : 20,
						$top,
						i18nHelper::detokenize($group->getName())
					);

					$features = array();
					foreach ($this->realty->getFeaturesByGroup($group) as $item) {
						$features[] = $item->getType()->getName();
					}

					$features = array_merge($features,$features,$features);
					$top += 4;
					$pdf->SetFont('Helvetica', '', 8);
					$pdf->SetTextColor(0x44, 0x44, 0x44);
					$top = $this->write(
						empty($text) ? 110 : 20,
						$top,
						implode(', ', $features),
						80,
						4,
						empty($text) ? null : 5
					);
					
					$top += 5;
				}
			}

			// Description
			$top = $descTop;
			$pdf->SetTextColor(0x44, 0x44, 0x44);
			$pdf->SetFont('Helvetica', '', 8);
			$this->write(110, $top, $text, 80, 3, 25);

			return $top;
		}

		private function write($left, $top, $text, $w = 0, $h = 3, $lines = null)
		{
			$pdf = $this->getPdf();

			$strings = array();
			$start = $pos = $offset = $line = 0;

			if (empty($w)) {
				$strings[] = $text;
			} else {
				while (empty($lines) ||$lines > $line) {
					if ($offset = mb_strpos($text, ' ', $offset)) {
						
						$substr = mb_substr($text, $start, $offset - $start);
						
						if ($pdf->GetStringWidth($substr) > $w) {
							$line++;
							$start = $pos;
						} else {
							$strings[$line] = $substr;
							$pos = $offset;
							$offset ++;
						}
					} else {
						$strings[$line] = mb_substr($text, $start);
						break;
					}
				}
			}

			foreach ($strings as $string) {
				$pdf->Text($left, $top, trim($string));
				$top += $h;
			}

			return $top;
		}

		/**
		 * @param const $orientation
		 * @param const $size
		 * @return FPDF
		 */
		private function getPdf($orientation = self::PORTRAIT, $size = self::A4)
		{
			if (empty($this->pdf)) {
				$this->pdf = new FPDF($orientation, self::UNIT, $size);
				$this->pdf->SetAuthor('Esperia Group of Companies', true);
				$this->pdf->SetTitle('Esperia Group of Companies');
				$this->pdf->SetFont('Helvetica', '', 12);
				$this->pdf->SetMargins(20, 10, 10);
				$this->pdf->AddPage(self::PORTRAIT);
			}

			return $this->pdf;
		}
	}