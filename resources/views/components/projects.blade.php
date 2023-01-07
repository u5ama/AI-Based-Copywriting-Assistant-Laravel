<div class="proj-dropdown sidemenu-opend dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <a href="#" class="d-h-flex">

            @foreach($projects as $project)
                @if($project->id == $currentUser->current_project)
                    @php
                        $selected_project_initial = Str::ucfirst($project->name[0]) .''. Str::ucfirst($project->name[1]);
                        $project_name = $project->name;
                    @endphp
                @endif
            @endforeach
            @isset($selected_project_initial)
                <span><b class="sort-nname">{{$selected_project_initial}}</b><img src="{{ asset('assets/admin/images/new/mp-img.svg') }}" class="mp-img"></span>
                <span>{{ $project_name }}</span>
                <span><img src="{{ asset('assets/admin/images/new/arrowup.svg') }}" class="mp-img-drp"></span>
            @else
                    <span><b class="sort-nname">{{ Str::ucfirst($projects[0]->name[0]) .''. Str::ucfirst($projects[0]->name[1])}}</b><img src="{{ asset('assets/admin/images/new/mp-img.svg') }}" class="mp-img"></span>
                    <span>{{ $projects[0]->name }}</span>
                    <span><img src="{{ asset('assets/admin/images/new/arrowup.svg') }}" class="mp-img-drp"></span>
            @endisset
        </a>
    </button>
    <ul class="dropdown-menu ts-dropdown" aria-labelledby="dropdownMenu">
        <div class="project-wrap">
            <h5>Create New Project <a href="#" data-toggle="modal" data-target="#createProject"><i class="fas fa-plus"></i></a></h5>
            @foreach($projects as $project)
                <div class="drp-user" >
                    <span class="name-ltr pointer"  onClick="change_project({{ $project->id }})">{{ Str::ucfirst($project->name[0]) .''. Str::ucfirst($project->name[1]) }}</span>
                    <span class="name-full pointer"  onClick="change_project({{ $project->id }})" data-id= "{{ $project->id }}">{{ $project->name }}<abbr> </abbr></span>
                    @if($project->id == $currentUser->current_project)
                        <span class="name-tick pointer"  onClick="change_project({{ $project->id }})">
                            <img src="{{ asset('assets/admin/images/new/green-check.svg') }}">
                        </span>
                    @endif
                    <div class="dropdown dot-drop">
                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="three-dot">...</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="#" data-toggle="modal" data-id="{{ $project->id }}" data-name="{{ $project->name }}" data-target="#createProject" onClick="rename_project(this)"><i class="fas fa-edit"></i> Rename</a></li>
                            @if (count($projects) > 1)
                                <li><a href="#" data-id="{{ $project->id }}" onClick="delete_project(this)"><i class="fas fa-trash-alt"></i> Delete</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </ul>
</div>
