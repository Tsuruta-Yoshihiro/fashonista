<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
                            
                            <!-- 年 -->
                            <select name="birth_year" wire:model="year" wire:change="onChange">
                                <option></option>
                                @for($i = 1960 ; $i <= date('Y') ; $i++)
                                <option value="{{ $i }}">{{ $i }}年</option>
                                @endfor
                            </select>
                            
                            <!-- 月 -->
                            <select name="birth_month" wire:model="month" wire:change="onChange">
                                <option></option>
                                @for($i = 1 ; $i <= 12 ; $i++)
                                <option value="{{ $i }}">{{ $i }}月</option>
                                @endfor
                            </select>
                            
                            <!-- 日 -->
                            <select name="birth_day" wire:model="day" wire:change="onChange">
                                <option></option>
                                @for($i = 1 ; $i <= $last_day_of_month ; $i++)
                                <option value="{{ $i }}">{{ $i }}日</option>
                                @endfor
                            </select>

                            <!-- 年齢 -->
                            @if($age > -1)
                                &nbsp;/&nbsp;{{ $age }} 才
                            @endif
                            
</div>
