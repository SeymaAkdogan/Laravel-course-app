<div class="list-group">
    @isset($categories)
        @foreach($categories as $category)

            <a href="/categories/{{$category['slug']}}" class="list-group-item list-group-item-action">
                {{$category['categoryName']}}
            </a>


        @endforeach
    @endisset
</div>
