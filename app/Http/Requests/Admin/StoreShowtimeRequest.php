<?php

namespace App\Http\Requests\Admin;

use App\Models\Showtime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreShowtimeRequest extends FormRequest
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

        if ($this->input('auto_generate_showtimes') === 'on') {
            return [
                'room_id' => [
                    'required',
                    'exists:rooms,id',
                    Rule::unique('showtimes')->where(function ($query) {
                        return $query->where('date', $this->date)
                            ->where('start_time', $this->start_time)
                            ->where('room_id', $this->room_id);
                    }),
                ],
                'movie_id' => 'required',
                // 'cinema_id' => 'required',
                'movie_version_id' => 'required|exists:movie_versions,id',
                'date' => 'required|date|after_or_equal:today',

                'start_hour' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $startTime = \Carbon\Carbon::parse($this->date . ' ' . $value);
                        if ($startTime->isPast()) {
                            $fail("Giờ mở cửa phải nằm trong tương lai.");
                        }

                        $startHour = Carbon::parse($this->date . ' ' . $value);

                        // Lấy các suất chiếu đã tồn tại trong phòng, ngày được chọn
                        $existingShowtimes = Showtime::where('room_id', $this->room_id)
                            ->where('date', $this->date)
                            ->get();

                        foreach ($existingShowtimes as $showtime) {
                            $existingStartTime = Carbon::parse($showtime->start_time);
                            $existingEndTime = Carbon::parse($showtime->end_time);

                            // Kiểm tra nếu giờ mở cửa nằm trong khoảng giờ chiếu
                            if ($startHour->between($existingStartTime, $existingEndTime)) {
                                $fail("Giờ mở cửa nằm trong khoảng thời gian chiếu của suất chiếu khác.");
                                return;
                            }
                        }
                    },
                ],
                'end_hour' => 'required|after:start_hour'
            ];
        }
        if ($this->input('auto_generate_showtimes') != 'on') {
            return [
                'room_id' => [
                    'required',
                    'exists:rooms,id',
                    Rule::unique('showtimes')->where(function ($query) {
                        return $query->where('date', $this->date)
                            ->where('start_time', $this->start_time)
                            ->where('room_id', $this->room_id);
                    }),
                ],
                'movie_id' => 'required',
                // 'cinema_id' => 'required',
                'movie_version_id' => 'required|exists:movie_versions,id',
                'date' => 'required|date|after_or_equal:today',

                'start_time.*' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $startTime = Carbon::parse($this->date . ' ' . $value);

                        // Kiểm tra giờ chiếu trong tương lai
                        if ($startTime->isPast()) {
                            $fail("Giờ chiếu phải nằm trong tương lai.");
                        }

                        // Lấy các suất chiếu hiện tại trong phòng và ngày
                        $existingShowtimes = Showtime::where('room_id', $this->room_id)
                            ->where('date', $this->date)
                            ->get();

                        // Kiểm tra trùng với các suất chiếu hiện có
                        foreach ($existingShowtimes as $showtime) {
                            $existingStartTime = Carbon::parse($showtime->start_time);
                            $existingEndTime = Carbon::parse($showtime->end_time);

                            // Nếu thời gian bắt đầu nằm giữa bất kỳ suất chiếu nào khác
                            if (
                                $startTime->between($existingStartTime, $existingEndTime) ||
                                $existingStartTime->between($startTime, $startTime->copy()->addMinutes($this->movie_duration))
                            ) {
                                $fail("Giờ chiếu $value bị trùng lặp với suất chiếu khác trong phòng.");
                                return;
                            }
                        }
                    },
                ],
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'room_id.required' => 'Vui lòng chọn phòng.',
            'room_id.exists' => 'Phòng đã chọn không tồn tại.',
            'room_id.unique' => 'Suất chiếu đã tồn tại cho phòng này vào thời gian bạn đã chọn.',
            'movie_id.required' => 'Vui lòng chọn phim.',
            'cinema_id.required' => 'Vui lòng chọn tên rạp.',
            'movie_version_id.required' => 'Vui lòng chọn phiên bản phim.',
            'movie_version_id.exists' => 'Phiên bản phim đã chọn không tồn tại.',
            'date.required' => 'Vui lòng chọn ngày chiếu.',
            'date.date' => 'Ngày chiếu không hợp lệ.',
            'date.after_or_equal' => 'Ngày chiếu phải từ hôm nay trở đi.',
            'start_time.*.required' => 'Vui lòng nhập giờ chiếu.',
            'start_time.*.date_format' => 'Giờ chiếu không hợp lệ (định dạng phải là HH:MM).',
            'start_time.*.after' => 'Giờ chiếu phải lớn hơn thời gian hiện tại.',
            'start_time.*.required_unless' => 'Giờ chiếu là bắt buộc nếu không bật tính năng tự động tạo suất chiếu.',
            'end_hour.required_if' => 'Vui lòng nhập giờ đóng cửa khi sử dụng tự động tạo suất chiếu.',
            'end_hour.after' => 'Giờ đóng cửa phải lớn hơn giờ mở cửa.',
            'start_hour.required' => 'Vui lòng nhập giờ mở cửa.',
            'end_hour.required' => 'Vui lòng nhập giờ đóng cửa.',
            'start_hour.required_if' => 'Vui lòng nhập giờ mở cửa khi sử dụng tự động tạo suất chiếu.',
        ];
    }


    // public function messages()
    // {
    //     return [
    //         'movie_id.required' => "Vui lòng chọn phim",
    //         'cinema_id.required' => "Vui lòng chọn Tên rạp",
    //         'branch_id.required' => "Vui lòng chọn Chi nhánh",
    //         'room_id.required' => 'Vui lòng chọn phòng.',
    //         'room_id.exists' => 'Phòng đã chọn không tồn tại.',
    //         'movie_version_id.required' => 'Vui lòng chọn phiên bản phim.',
    //         'movie_version_id.exists' => 'Phiên bản phim đã chọn không tồn tại.',
    //         'date.required' => 'Vui lòng chọn ngày chiếu.',
    //         'date.date' => 'Ngày chiếu không hợp lệ.',
    //         'date.after_or_equal' => 'Ngày chiếu phải từ hôm nay trở đi.',
    //         'start_time.required' => 'Vui lòng chọn giờ chiếu.',
    //         'start_time.date_format' => 'Giờ chiếu không hợp lệ (định dạng phải là HH:MM).',
    //         'start_time.after' => 'Giờ chiếu phải lớn hơn thời gian hiện tại.',
    //         'start_time.before' => 'Giờ chiếu phải trước giờ kết thúc.',
    //         'end_time.required' => 'Vui lòng nhập giờ kết thúc.',
    //         'end_time.date_format' => 'Giờ kết thúc không hợp lệ (định dạng phải là HH:MM).',
    //         'end_time.after' => 'Giờ kết thúc phải sau giờ chiếu.',
    //         'end_hour.required' => "Vui lòng nhập giờ đóng cửa",
    //         'end_hour.after' => 'Giờ đóng cửa phải lớn hơn giờ mở cửa',
    //     ];
    // }
}
