@component('mail::message')
    Pershendetje {{ $employee->first_name }} {{ $employee->last_name }},

    Sot eshte data {{ now()->toDateString() }}, kane mbetur {{ now()->daysInMonth - now()->day }} dite deri ne fund te
    muajit. Ju lutem logoni oret e dites se djeshme!

    Faleminderit,
    ATIS Software Company
@endcomponent
