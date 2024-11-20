<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShowtimeRequest extends FormRequest
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
        $id = $this->route('showtime')->id;
        return [

            'room_id' => [
                'required',
            ],
            'movie_id' => 'required',
            // 'cinema_id' => 'required',
            // 'branch_id' => 'required',
            'movie_version_id' => 'required|exists:movie_versions,id',
            'date' => 'required|date|after_or_equal:today',   //ngăn chặn chọn ngày trog quá khứ
            'start_time' => 'required',
            'end_time' => 'required',

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $roomId = $this->room_id; // ID phòng
            $date = $this->date; // Ngày chiếu
            $startTime = \Carbon\Carbon::parse($this->date . ' ' . $this->start_time); // Giờ bắt đầu
            $movieDuration = $this->movie_id ? \App\Models\Movie::find($this->movie_id)->duration : 0;
            $cleaningTime = \App\Models\Showtime::CLEANINGTIME;
            $endTime = $startTime->copy()->addMinutes($movieDuration + $cleaningTime); // Giờ kết thúc

            // Truy vấn các suất chiếu khác trong cùng phòng và ngày
            $conflictingShowtimes = \App\Models\Showtime::where('room_id', $roomId)
                ->where('date', $date)
                ->where('id', '!=', $this->route('showtime')->id) // Loại bỏ suất chiếu hiện tại
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                        ->orWhereBetween('end_time', [$startTime, $endTime])
                        ->orWhere(function ($query) use ($startTime, $endTime) {
                            $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                        });
                })
                ->exists();

            // Nếu phát hiện trùng lặp, thêm lỗi
            if ($conflictingShowtimes) {
                $validator->errors()->add('start_time', 'Giờ chiếu trùng lặp với suất chiếu khác.');
            }
        });
    }


    public function messages()
    {
        return [
            'movie_id.required' => "Vui lòng chọn phim",
            'cinema_id.required' => "Vui lòng chọn Tên rạp",
            'branch_id.required' => "Vui lòng chọn Chi nhánh",
            'room_id.required' => 'Vui lòng chọn phòng.',
            'room_id.exists' => 'Phòng đã chọn không tồn tại.',
            'movie_version_id.required' => 'Vui lòng chọn phiên bản phim.',
            'movie_version_id.exists' => 'Phiên bản phim đã chọn không tồn tại.',
            'date.required' => 'Vui lòng chọn ngày chiếu.',
            'date.date' => 'Ngày chiếu không hợp lệ.',
            'date.after_or_equal' => 'Ngày chiếu phải từ hôm nay trở đi.',

            'start_time.required' => 'Vui lòng chọn giờ chiếu.',
            'start_time.date_format' => 'Giờ chiếu không hợp lệ (định dạng phải là HH:MM).',
            'start_time.before' => 'Giờ chiếu phải trước giờ kết thúc.',
            'start_time.unique' => 'Giờ chiếu trùng lặp với suất chiếu khác.',
            'end_time.required' => 'Vui lòng nhập giờ kết thúc.',
            'end_time.date_format' => 'Giờ kết thúc không hợp lệ (định dạng phải là HH:MM).',
            'end_time.after' => 'Giờ kết thúc phải sau giờ chiếu.',
        ];
    }
}
