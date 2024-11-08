<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        
        $rules = [
            "name" => "required|max:100",
            "image" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
            "category" => "required|not_in:0",
            "brand" => "required|not_in:0",
            'galleries.*' => 'nullable|mimes:jpeg,png,jpg,gif,mp4|max:10240',
            "images.*" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "colors.*" => "required|not_in:0",
            "ssds.*" => "required|not_in:0",
            "images.*" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "importPrices.*" => "required|integer|min:1000|max:99999999999",
            "listedPrices.*" => "required|integer|min:1000|max:99999999999",
            "prices.*" => "required|integer|min:1000|max:99999999999",
            "quantities.*" => "required|integer|min:1|max:9999999999"
        ];

        if ($this->route()->getName() === 'product.update') {
            $rules["image"] = "nullable|image|mimes:jpeg,png,jpg,gif|max:2048";
        }
        
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống tên sản phẩm',
            'name.max' => 'Tên sản phẩm quá dài',
            'image.required' => 'Không được để trống ảnh',
            'image.image' => 'Ảnh sai định dạng',
            'image.mimes' => 'Ảnh phải là jpeg, png, jpg, gif',
            'image.max' => 'Dung lượng ảnh quá lớn',
            'category' => 'Không được để trống danh mục',
            'brand' => 'Không được để trống hãng',
            'galleries.*.mimes' => 'Định dạng file không chính xác',
            'galleries.*.max' => 'Dung lượng file quá lớn',
            'images.*.required' => 'Ko được trống',
            'images.*.image' => 'Ảnh sai định dạng',
            'images.*.mimes' => 'Ảnh phải là jpeg, png, jpg, gif',
            'images.*.max' => 'Dung lượng ảnh quá lớn',
            'colors.*' => 'Không được trống',
            'ssds.*' => 'Không được trống',
            'importPrices.*.required' => 'Không được trống giá nhập',
            'importPrices.*.integer' => 'Giá phải là số nguyên',
            'importPrices.*.min' => 'Giá phải lớn hơn 1000',
            'importPrices.*.max' => 'Giá quá lớn',
            'listedPrices.*.required' => 'Không được trống giá niêm yết',
            'listedPrices.*.integer' => 'Giá phải là số nguyên',
            'listedPrices.*.min' => 'Giá phải lớn hơn 1000',
            'listedPrices.*.max' => 'Giá quá lớn',
            'prices.*.required' => 'Không được trống giá bán',
            'prices.*.integer' => 'Giá phải là số nguyên',
            'prices.*.min' => 'Giá phải lớn hơn 1000',
            'prices.*.max' => 'Giá quá lớn',
            'quantities.*.required' => 'Không được trống số lượng',
            'quantities.*.integer' => 'Số lượng phải là số nguyên',
            'quantities.*.min' => 'Số lượng phải lớn hơn 1',
            'quantities.*.max' => 'Số lượng lớn'
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $importPrices = $this->input('importPrices');
            $listedPrices = $this->input('listedPrices');
            $prices = $this->input('prices');
            $colors = $this->input('colors');
            $ssds = $this->input('ssds');

            if (count($importPrices) !== count($listedPrices) || count($importPrices) !== count($prices)) {
                $validator->errors()->add('listedPrices', 'Vui lòng nhập đầy đủ các giá');
            }

            foreach ($importPrices as $key => $value) {
                if ($importPrices[$key] >= $listedPrices[$key]) {
                    $validator->errors()->add("listedPrices.$key", "Giá niêm yết phải lớn hơn giá nhập");
                }

                if ($listedPrices[$key] <= $prices[$key]) {
                    $validator->errors()->add("prices.$key", "Giá bán phải nhỏ hơn giá niêm yết");
                }

                if ($prices[$key] <= $importPrices[$key]) {
                    $validator->errors()->add("prices.$key", "Giá bán phải lớn hơn giá nhập");
                }
            }

            $colorSsdPairs = [];

            foreach ($colors as $key => $color) {
                if (isset($ssds[$key])) {
                    $pair = [$color, $ssds[$key]]; // Kết hợp màu và SSD thành mảng
                    if (in_array($pair, $colorSsdPairs)) {
                        $validator->errors()->add("colors.$key", "Trùng thuộc tính");
                        $validator->errors()->add("ssds.$key", "Trùng thuộc tính");
                    } else {
                        $colorSsdPairs[] = $pair;
                    }
                }
            }
        });
    }
}