<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdfFiles;
use App\Models\User;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

/**
 *PdfController class
 * 
 * This class is built to create backend application interface.
 *
 * @author          Tajinder Singh
 */

class PdfController extends Controller
{
    /**
     *index function
     * 
     * This function is called to list uploaded files.
     * 
     * @access          public
     * @param           
     * @return          params
     * @author          Tajinder Singh
     */
    public function index(){

        $obj  = new User();
        $data = $obj::get();
        return view('list', compact('data'));
    }

    /**
     *index function
     * 
     * This function is called to add pdf files.
     * 
     * @access          public
     * @param           
     * @return          params
     * @author          Tajinder Singh
     */

    public function create(){
        return view('add');
    }

    /**
     *index function
     * 
     * This function is called to store pdf files into database.
     * 
     * @access          public
     * @param           
     * @return          params
     * @author          Tajinder Singh
     */
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            // 'files' => 'required',
            // 'files' => 'mimetypes:application/pdf',
        ]);
        if ($request->file('files')){
            $user = new User();
            $user->title = $request->title;
            $user->save();
            $id = $user->id;
            foreach($request->file('files') as $key => $file)
            {
                $pdf_files = new PdfFiles();
                $fileName = time().rand(1,99).'.'.$file->extension();  
                $file->move(public_path('assets/pdf'), $fileName);
                $pdf_files->pdf = $fileName;
                $pdf_files->user_id = $id;
                $pdf_files->save();
            }
        }
        return redirect('/')->with('success', "Files Uploaded");
    }


    /**
     *index function
     * 
     * This function is called to merge multiple pdf files in single file.
     * 
     * @access          public
     * @param           
     * @return          params
     * @author          Tajinder Singh
     */

    public function downloadPdf(Request $request){

        $obj = new PdfFiles();
        $data = $obj::where('user_id', $request->id)->get();
        $pdf = PDFMerger::init();
        foreach ($data as $key => $value) {
            $pth = "assets\pdf\ ".$value->pdf;
            $string = preg_replace('/\s+/', '', $pth);
            $pdf->addPDF(public_path($string), 'all');
        }
        $fileName = time().'.pdf';
        $pdf->merge();
        $pdf->save(public_path($fileName));
        return response()->download(public_path($fileName));
    }

    /**
     *downloadMultiplePdf function
     * 
     * This function is called to merge selected pdf files in single file.
     * 
     * @access          public
     * @param           
     * @return          params
     * @author          Tajinder Singh
     */
    
    public function downloadMultiplePdf(Request $request){

        if(!empty($request->ids)){
            $files = [];
            foreach($request->ids as $id){
                $obj = new PdfFiles();
                $data = $obj::where('user_id', $id)->get();
                foreach($data as $pfile){
                $files[]['pdf'] = $pfile->pdf;
                }
            }
            $obj = new PdfFiles();
            $pdf = PDFMerger::init();
            foreach ($files as $key => $value) {
                $pth = "assets\pdf\ ".$value['pdf'];
                $string = preg_replace('/\s+/', '', $pth);
                $pdf->addPDF(public_path($string), 'all');
            }
            $fileName = time().'.pdf';
            $pdf->merge();
            $pdf->save(public_path($fileName));
            return response()->download(public_path($fileName));
        }else{
            return redirect('/')->with('error', "Please select the files");
        }
    }
}