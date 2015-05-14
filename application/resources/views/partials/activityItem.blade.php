@if(get_class($item) == "App\PlayerBan")
<a href="{{ url('/admin/bans/'.$item->serverId.'/'.$item->id) }}" class="list-group-item">
	<i class="fa fa-ban fa-fw"></i> {{ trans('app.newBan') }} ({{ $item->player->name }})
	<span class="pull-right text-muted small"><em>{{ $item->created->diffForHumans() }}</em>
	</span>
</a>
@elseif(get_class($item) == "App\PlayerBanRecord")
<a href="{{ url('/admin/players/'.$item->player->uuid) }}" class="list-group-item">
	<i class="fa fa-check fa-fw"></i> {{ ucfirst(trans('app.unbanned')) }} ({{ $item->player->name }})
	<span class="pull-right text-muted small"><em>{{ $item->created->diffForHumans() }}</em>
	</span>
</a>
@elseif(get_class($item) == "App\PlayerMute")
<a href="{{ url('/admin/mutes/'.$item->serverId.'/'.$item->id) }}" class="list-group-item">
	<i class="fa fa-microphone-slash fa-fw"></i> {{ trans('app.newMute') }} ({{ $item->player->name }})
	<span class="pull-right text-muted small"><em>{{ $item->created->diffForHumans() }}</em>
	</span>
</a>
@elseif(get_class($item) == "App\PlayerMuteRecord")
<a href="{{ url('/admin/players/'.$item->player->uuid) }}" class="list-group-item">
	<i class="fa fa-microphone fa-fw"></i> {{ ucfirst(trans('app.unmuted')) }} ({{ $item->player->name }})
	<span class="pull-right text-muted small"><em>{{ $item->created->diffForHumans() }}</em>
	</span>
</a>
@elseif(get_class($item) == "App\PlayerNote")
<a href="{{ url('/admin/notes/'.$item->serverId.'/'.$item->id) }}" class="list-group-item">
	<i class="fa fa-paperclip fa-fw"></i> {{ trans('app.newNote') }} ({{ $item->player->name }})
	<span class="pull-right text-muted small"><em>{{ $item->created->diffForHumans() }}</em>
	</span>
</a>
@elseif(get_class($item) == "App\PlayerWarning")
<a href="{{ url('/admin/warnings/'.$item->serverId.'/'.$item->id) }}" class="list-group-item">
	<i class="fa fa-comment fa-fw"></i> {{ trans('app.newWarning') }} ({{ $item->player->name }})
	<span class="pull-right text-muted small"><em>{{ $item->created->diffForHumans() }}</em>
	</span>
</a>
@elseif(get_class($item) == "App\PlayerKick")
<a href="{{ url('/admin/kicks/'.$item->serverId.'/'.$item->id) }}" class="list-group-item">
	<i class="fa fa-user-times fa-fw"></i> {{ trans('app.newKick') }} ({{ $item->player->name }})
	<span class="pull-right text-muted small"><em>{{ $item->created->diffForHumans() }}</em>
	</span>
</a>
@endif