<h1>
    {{ $response->resultCount }} results
</h1>

<ul>
    @foreach ($response->results as $result)
        <li>
            {{ $result->trackName }} by {{ $result->artistName }}
            on {{ isset($result->collectionName) ? $result->collectionName : "N/A" }}
        </li>
    @endforeach
</ul>