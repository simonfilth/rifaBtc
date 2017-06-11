<nav v-if="pagination.last_page > 1"  v-cloak>
    <ul class="pagination">
        <li v-if="pagination.current_page > 1">
            <a href="#" aria-label="{{trans('mensajes.previous')}}" @click.prevent="changePage(pagination.current_page - 1)">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]">
            <a href="#" @click.prevent="changePage(page)">
                @{{ page }}
            </a>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
            <a href="#" aria-label="{{trans('mensajes.next')}}" @click.prevent="changePage(pagination.current_page + 1)">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>