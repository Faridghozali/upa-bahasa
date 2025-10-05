<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'date' => 'required|date',
            'test_time' => 'required|date_format:H:i',
            'room_id' => 'required|exists:rooms,id',
            'quota' => 'required|integer|min:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'day' => __('schedule.day'),
            'date' => __('schedule.date'),
            'test_time' => __('schedule.test_time'),
            'room_id' => __('schedule.room_id'),
            'quota' => __('schedule.quota'),
        ];
    }
}
