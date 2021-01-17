<nav id="sidebar" class="col-md-2 text-right">
    <div class="sidebar-header">
        <h3>Menu Sidebar</h3>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Drugs</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="{{ route('drugs.create') }}">Create</a>
                </li>
                <li>
                    <a href="{{ route('drugs.index') }}">List</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#homeSubstance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Substance</a>
            <ul class="collapse list-unstyled" id="homeSubstance">
                <li>
                    <a href="{{ route('substances.create') }}">Create</a>
                </li>
                <li>
                    <a href="{{ route('substances.index') }}">List</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>