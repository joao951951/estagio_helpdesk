@props(['rota'])

<a href="{{ route($rota) }}"
    style="font-size: 0.7rem;"
    onmouseover="this.style.textDecoration='underline'"
    onmouseout="this.style.textDecoration='none'"
>
    {{ $slot }}
</a>
