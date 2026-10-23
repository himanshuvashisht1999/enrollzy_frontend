{{-- One round's dates (title + table), used in "All rounds' dates". --}}
<p style="margin:10px 0 6px"><b>{{ $title }}</b></p>
<div class="cz-tbl-wrap">
    <table>
        <tbody>
            @foreach($events as $e)
                <tr>
                    <td>{{ $e['label'] ?: $e['type']['name'] }}@if($e['quota'])<span class="small">{{ $e['quota'] }}</span>@endif</td>
                    <td class="cz-num">{{ $e['date_text'] }}</td>
                    <td>{{ \App\Support\CounsellingUi::eventPillHtml($e) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
