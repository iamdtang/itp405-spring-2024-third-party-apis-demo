<h1>
    {{ $response->resultCount }} results
</h1>

<ul>
    @foreach ($response->results as $result)
        <li>
            {{$result->trackName ?? "Missing track name"}} by {{ $result->artistName }}
            on {{ $result->collectionName ?? "N/A" }}
        </li>
    @endforeach
</ul>