<span class="icon-blog-search scope search_activator"></span>
<div class="search_form">
    <form action="/">
        <div class="searchinputcont">
            <input class="blog-search__input js-posts-search-input" autocomplete="off" name="s" type="text" value="<?php echo get_search_query() ?>" placeholder="<?php _e( 'Search', 'davinciwoo' ) ?>" />
            <div class="scopes">
                <span class="scope2 blog-search__btn"><i class="icon-blog-search"></i></span>
                <span class="clearsearch"><i class="icon-cancel"></i></span>
            </div>
        </div>
        <div class="search_items">
            <script id="tmpl-search_items" type="text/html">
                {{#each posts}}
                <div class="search_item">
                    <h3><a href="{{url}}">{{title}}</a></h3>
                    <div class="blog_stats">
                        <span class="blog_date">{{date}}</span>
                        <div class="blog_tags">{{{category}}}</div>
                    </div>
                    <a href="{{url}}">{{{excerpt}}}</a>
                </div>
                {{/each}}
            </script>
        </div>
        <input type="hidden" name="post_type" value="post"/>
    </form>
</div>