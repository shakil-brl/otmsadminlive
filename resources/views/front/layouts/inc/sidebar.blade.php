<section id="sidebar">
    <div class="top">
        <div class="logo">
            <a href="#">
                <img src="{{ asset('front') }}/img/logo.svg" alt="">
            </a>
        </div>
    </div>
    <ul class="list-unstyled m-0 menu accordion" id="sidebar-menu">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <span class="material-icons-outlined">
                    grid_view
                </span>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link active">
                <span class="material-icons-outlined">
                    dynamic_form
                </span>
                Batch
            </a>
        </li>
        <!-- collapse menu -->
        <li class="nav-item accordion-item">
            <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne">
                <span class="material-icons-outlined">
                    people
                </span>
                User
            </a>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                <div class="accordion-content">
                    <a href="" class="nav-link">
                        - List
                    </a>
                    <a href="" class="nav-link active">
                        - Add New
                    </a>
                    <a href="" class="nav-link">
                        - Reset
                    </a>
                    </a>

                </div>
            </div>
        </li>
        <!-- End collapse menu -->

    </ul>
</section>
