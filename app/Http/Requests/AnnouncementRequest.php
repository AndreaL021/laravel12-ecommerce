<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Announcement;

class AnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:30'],
            'des' => ['required', 'string', 'min:10', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['exists:categories,id'],
        ];
        if ($this->isMethod('post')) {
            // creazione
            $rules['images'] = ['required', 'array', 'min:1', 'max:5'];
            $rules['images.*'] = ['image', 'max:2048'];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // aggiornamento
            $announcement = $this->route('announcement');

            $remainingSlots = max(0, 5 - $announcement->images()->count());

            // Permetti upload solo se c'è ancora spazio
            if ($remainingSlots > 0) {
                $rules['images'] = ['nullable', 'array', "max:$remainingSlots"];
                $rules['images.*'] = ['image', 'max:2048'];
            } else {
                // Non permettere altre immagini
                $rules['images'] = ['prohibited'];
            }
        }
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->isMethod('put')) {
                $announcement = $this->route('announcement');
                $hasExistingImages = $announcement && $announcement->images()->count() > 0;

                if (!$hasExistingImages && !$this->hasFile('images')) {
                    $validator->errors()->add('images', __('validation.images-required'));
                }
            }
        });
    }
}
