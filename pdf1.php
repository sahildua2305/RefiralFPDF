<?php
require('fpdf/fpdf.php');
//require('fpdf/WordWrap.php');

class PDF extends FPDF{
	
	function WordWrap(&$text, $maxwidth)
	{
		$text = trim($text);
		if ($text==='')
			return 0;
		$space = $this->GetStringWidth(' ');
		$lines = explode("\n", $text);
		$text = '';
		$count = 0;

		foreach ($lines as $line)
		{
			$words = preg_split('/ +/', $line);
			$width = 0;

			foreach ($words as $word)
			{
				$wordwidth = $this->GetStringWidth($word);
				if ($wordwidth > $maxwidth)
				{
					// Word is too long, we cut it
					for($i=0; $i<strlen($word); $i++)
					{
						$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
						if($width + $wordwidth <= $maxwidth)
						{
							$width += $wordwidth;
							$text .= substr($word, $i, 1);
						}
						else
						{
							$width = $wordwidth;
							$text = rtrim($text)."\n".substr($word, $i, 1);
							$count++;
						}
					}
				}
				elseif($width + $wordwidth <= $maxwidth)
				{
					$width += $wordwidth + $space;
					$text .= $word.' ';
				}
				else
				{
					$width = $wordwidth + $space;
					$text = rtrim($text)."\n".$word.' ';
					$count++;
				}
			}
			$text = rtrim($text)."\n";
			$count++;
		}
		$text = rtrim($text);
		return $count;
	}
	
	
	//Page Header
	function Header(){
		
		$this->Image('http://www.refiral.com/my/vendor/uploads/logo/logo_186.png', 150, 6, 50, 15);
		$this->SetFont('Arial', 'B', 19);
		$this->Cell(80, 20, 'In just one month with', 0, 0, 'C');
		$this->Image('http://www.refiral.com/my/images/logo.png', 87, 15, 40, 10);
		$this->Ln();
		$this->SetFont('Arial', 'B', 20);
		$this->SetTextColor(220,50,50);
		$this->Cell(180, 15, '19000 unique impressions about Wall Design!', 0, 0, 'R');
		$this->Ln();
		$this->SetTextColor(0,188,86);
		$this->Cell(175, 10, '3800 new people know about Wall Design!', 0, 0, 'R');
		$this->Ln(15);
		
		//one rectangular block
		$this->SetFont('Arial', 'B', 17);
		$title = '1524 website visits';
		$w = $this->GetStringWidth($title)+36;
		$this->SetX(20);
		$this->SetX(20);
		$this->SetDrawColor(255,255,255);
		$this->SetFillColor(0,145,190);
		$this->SetTextColor(255,255,255);
		$this->SetLineWidth(0);
		$this->Cell($w,14,$title,1,1,'C',true);
		$this->Ln(2);
		//.....................
		
		//one rectangular block
		$this->SetFont('Arial', 'B', 15);
		$title = '95 discount button clicks';
		$w = $this->GetStringWidth($title)+13;
		$this->SetX(27);
		$this->SetDrawColor(255,255,255);
		$this->SetFillColor(204,101,104);
		$this->SetTextColor(255,255,255);
		$this->SetLineWidth(0);
		$this->Cell($w,14,$title,1,1,'C',true);
		$this->Ln(2);
		//.....................
		
		//one rectangular block
		$this->SetFont('Arial', 'B', 15);
		$title = '19 shares 7 tweets';
		$w = $this->GetStringWidth($title)+14;
		$this->SetX(35);
		$this->SetDrawColor(255,255,255);
		$this->SetFillColor(253,216,76);
		$this->SetTextColor(0,0,0);
		$this->SetLineWidth(0);
		$this->Cell($w,14,$title,1,1,'C',true);
		$this->Ln(2);
		//.....................
		
		//one rectangular block
		$this->SetFont('Arial', 'B', 15);
		$title = '78 friend clicks';
		$w = $this->GetStringWidth($title)+8;
		$this->SetX(42);
		$this->SetDrawColor(255,255,255);
		$this->SetFillColor(1,154,1);
		$this->SetTextColor(255,255,255);
		$this->SetLineWidth(0);
		$this->Cell($w,14,$title,1,1,'C',true);
		$this->Ln(2);
		//.....................
		
	}
	
	function Insights(){
		global $header, $data;
		
		$this->SetDrawColor(255,0,0);
		$this->SetFillColor(210,210,210);
		$this->SetTextColor(255,0,0);
		$this->SetLineWidth(1.0);
		$this->SetFont('Arial', 'I', 16);
		$this->SetLeftMargin(115);
		$this->SetY(60);
		$this->Cell(85, 12, 'Key customer insights', 1, 0, 'C', true);
		
		$this->SetDrawColor(0,0,255);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetLineWidth(0.3);
		$this->SetFont('Arial', '', 15);
		$this->SetLeftMargin(115);
		$this->SetY(72.5);
		$this->Cell(85, 10, ' >  Cities with maximum traffic:', 'LR', 1, 'L', true);
		$this->Cell(85, 8, '        > Bangalore (~21%)', 'LR', 1, '', true);
		$this->Cell(85, 8, '        > Delhi(NCR) (~21%)', 'LR', 1, '', true);
		$this->Cell(85, 8, '        > Hyderabad (~11%)', 'LR', 1);
		$this->Cell(85, 8, '        > Mumbai (~9%)', 'LR', 1);
		$this->Cell(85, 10, ' >  ~81% shares/tweets by Males', 'LRB', 1);
		
		$this->Ln(20);
	}
	
	function InsightsFooter1(){
		global $header, $data;
		
		$this->SetDrawColor(255,0,0);
		$this->SetFillColor(210,210,210);
		$this->SetTextColor(255,0,0);
		$this->SetLineWidth(1.0);
		$this->SetFont('Arial', 'I', 16);
		$this->SetX(10);
		$this->SetLeftMargin(13);
		$this->SetY(130);
		$this->Cell(187, 12, 'Product improvements in last month', 1, 0, 'C', true);
		
		$this->SetDrawColor(0,0,255);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetLineWidth(0.3);
		$this->SetFont('Arial', '', 15);
		$this->SetLeftMargin(13);
		$this->SetY(142.5);
		$this->Cell(187, 10, '  > Removed pop-up block feature on Facebook, Twitter and Google+', 'LR', 1, 'L', true);
		$this->Cell(187, 8, '  > Decreased load times on all pages - increased speed by ~25%', 'LR', 1, 'L', true);
		$this->Cell(187, 8, '  > Integrated on 2 more versions of Internet Explorer', 'LR', 1, 'L', true);
		$this->Cell(187, 8, '  > Added Hashtag tracking for all posts/tweets to improve analytics', 'LRB', 1, 'L', true);
		$this->Ln(10);
	}
	
	function InsightsFooter2(){
		global $header, $data;
		
		$this->SetDrawColor(255,0,0);
		$this->SetFillColor(210,210,210);
		$this->SetTextColor(255,0,0);
		$this->SetLineWidth(1.0);
		$this->SetFont('Arial', 'I', 16);
		$this->SetX(10);
		$this->SetLeftMargin(13);
		$this->SetY(183);
		$this->Cell(187, 12, 'Product roadmap in coming month', 1, 0, 'C', true);
		
		$this->SetDrawColor(0,0,255);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetLineWidth(0.3);
		$this->SetFont('Arial', '', 15);
		$this->SetLeftMargin(13);
		$this->SetY(195.5);
		$this->Cell(187, 10, '  > Your website feature on Refiral FB group - to increase traffic and publicity', 'LR', 1, 'L', true);
		$this->Cell(187, 8, '  > Improving interface features - new design templates for pop-ups & emails', 'LR', 1, 'L', true);
		$this->Cell(187, 8, '  > Adding more sharing platforms - Facebook message, direct mails etc.', 'LR', 1, 'L', true);
		$this->Cell(187, 8, '  > Sending FREE emails for each person who shares on social media', 'LRB', 1, 'L', true);
	}
	
	function footer(){
		$this->SetTextColor(255,0,0);
		$this->SetFont('Arial', 'I', 19);
		$this->Cell(80, 13, 'We\'re always listening!', 0, 0, 'L');
		$this->Ln(10);
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', '', 16);
		$text = 'Help us improve, share your feedback and suggestions. Want an additional feature? Or just want to say Hi, write to us at hello@refiral.com. We\'re all ears!';
		$this->WordWrap($text,187);
		$this->Write(7, $text);
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', 'B', 19);
		$this->Cell(80, 13, 'Looking forward to a successful May! :)', 0, 0, 'L');
		$this->Ln(15);
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', '', 16);
		$this->Cell(30, 7, 'Cheers,', 0, 0, 'L');
		$this->Ln();
		$this->Cell(30, 7, 'Team Refiral', 0, 0, 'L');
		$this->Ln(10);
	}
}

$pdf = new PDF();
//$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Insights();
$pdf->InsightsFooter1();
$pdf->InsightsFooter2();
$pdf->Output();
$filename="./test";
$pdf->Output($filename.'.pdf','F');
?>