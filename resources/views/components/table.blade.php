<div>
    <table class="table">
        <thead>
            <tr>
                @foreach($headers as $header)
                     <th class="{{ $header['class'] }}">
                        {{ $header['label'] }}
                      
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    @foreach($headers as $header)
                        <td>{{ $row[$header['key']] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

