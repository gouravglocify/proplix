public function printReport(){
		$data['title'] = 'Report List';
		$data['reports'] = Report::orderBy('created_at', 'desc')->paginate(5);

		$pdf = PDF::loadView('reports.print', $data);
		return $pdf->download('report.pdf');
	}