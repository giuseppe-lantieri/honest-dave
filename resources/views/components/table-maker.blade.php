@if ($index %$cols==0)
<tr>
    @endif
    <td>
        {{ $slot }}
    </td>
    @if ($index %$cols==($cols-1))
</tr>
@endif