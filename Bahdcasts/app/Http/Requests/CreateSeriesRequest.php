<?php

namespace Bahdcasts\Http\Requests;

use Bahdcasts\Series;
use Illuminate\Foundation\Http\FormRequest;

class CreateSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ];
    }

    public function uploadSeriesImage(){
        $uploadedImage=$this->image;
        //upload file
        $this->fileName=str_slug($this->title).'.'.$uploadedImage->getClientOriginalExtension();
        $uploadedImage->storePubliclyAs(
            'public/series', $this->fileName
        );
        return $this;
    }

    public function storeSeries(){
        //create series
        $series=Series::create([
            'title' => $this->title,
            'slug' => str_slug($this->title),
            'description' => $this->description,
            'image_url' => 'series/'.$this->fileName
        ]);

        session()->flash('success', 'Series created successfully.');
        //redirect user to a page to see all series
        return redirect()->route('series.show', $series->slug);
    }
}
