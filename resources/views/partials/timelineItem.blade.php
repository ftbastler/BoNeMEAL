@if(get_class($item) == "App\PlayerBan")
<li class="timeline">
	<div class="timeline-badge danger"><i class="fa fa-ban fa-fw"></i></div>
	<div class="timeline-panel">
		<div class="timeline-heading">
			<h4 class="timeline-title">{{ ucfirst(trans('app.banned')) }}</h4>
			<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $item->created_at->diffForHumans() }}</small>
				<small class="text-muted"><i class="glyphicon glyphicon-user"></i> {{ $item->actor->name }}</small></p>
			</div>
			<div class="timeline-body">
				@if($item->reason)
				{{ ucfirst(trans('app.reason')) }}: {{ $item->reason }}
				@endif
				<br />
				@if($item->expires->timestamp == 0)
				{{ trans('app.noExpire') }}
				@else
				{{ ucfirst(trans('app.expires')) }} {{ $item->expires->diffForHumans() }}.
				<br /><br />
				
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="{{ timePasedToPercent($item->expires, $item->created) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ timePasedToPercent($item->expires, $item->created) }}%;">
						{{ timePasedToPercent($item->expires, $item->created) }}%
					</div>
				</div>
				@endif
			</div>
		</div>
	</li>
	@elseif(get_class($item) == "App\PlayerBanRecord")
	<li class="timeline-inverted">
		<div class="timeline-badge success"><i class="fa fa-ban fa-fw"></i></div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title"><s>{{ ucfirst(trans('app.banned')) }}</s></h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $item->created_at->diffForHumans() }}</small>
					<small class="text-muted"><i class="glyphicon glyphicon-user"></i> {{ $item->pastActor->name }}</small></p>
				</div>
				<div class="timeline-body">
					@if($item->reason)
					{{ ucfirst(trans('app.reason')) }}: {{ $item->reason }}
					@endif
					<br />
					<strong>{{ trans('app.unbannedBy', ['time' => $item->created->diffForHumans(), 'actor' => $item->actor->name]) }}</strong>
				</div>
			</div>
		</li>
		@elseif(get_class($item) == "App\PlayerMute")
		<li class="timeline">
			<div class="timeline-badge danger"><i class="fa fa-microphone-slash fa-fw"></i></div>
			<div class="timeline-panel">
				<div class="timeline-heading">
					<h4 class="timeline-title">{{ ucfirst(trans('app.muted')) }}</h4>
					<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $item->created_at->diffForHumans() }}</small>
						<small class="text-muted"><i class="glyphicon glyphicon-user"></i> {{ $item->actor->name }}</small></p>
					</div>
					<div class="timeline-body">
						@if($item->reason)
						{{ ucfirst(trans('app.reason')) }}: {{ $item->reason }}
						@endif
						<br />
						@if($item->expires->timestamp == 0)
						{{ trans('app.noExpire') }}
						@else
						{{ ucfirst(trans('app.expires')) }} {{ $item->expires->diffForHumans() }}.
						<br /><br />

						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="{{ timePasedToPercent($item->expires, $item->created) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ timePasedToPercent($item->expires, $item->created) }}%;">
								{{ timePasedToPercent($item->expires, $item->created) }}%
							</div>
						</div>
						@endif
					</div>
				</div>
			</li>
			@elseif(get_class($item) == "App\PlayerMuteRecord")
			<li class="timeline-inverted">
				<div class="timeline-badge success"><i class="fa fa-microphone-slash fa-fw"></i></div>
				<div class="timeline-panel">
					<div class="timeline-heading">
						<h4 class="timeline-title"><s>{{ ucfirst(trans('app.muted')) }}</s></h4>
						<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $item->created_at->diffForHumans() }}</small>
							<small class="text-muted"><i class="glyphicon glyphicon-user"></i> {{ $item->pastActor->name }}</small></p>
						</div>
						<div class="timeline-body">
							@if($item->reason)
							{{ ucfirst(trans('app.reason')) }}: {{ $item->reason }}
							@endif
							<br />
							<strong>{{ trans('app.unmutedBy', ['time' => $item->created->diffForHumans(), 'actor' => $item->actor->name]) }}</strong>
						</div>
					</div>
				</li>
				@elseif(get_class($item) == "App\PlayerNote")
				<li class="timeline">
					<div class="timeline-badge info"><i class="fa fa-paperclip fa-fw"></i></div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">{{ ucfirst(trans('app.noteAdded')) }}</h4>
							<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $item->created_at->diffForHumans() }}</small>
								<small class="text-muted"><i class="glyphicon glyphicon-user"></i> {{ $item->actor->name }}</small></p>
							</div>
							<div class="timeline-body">
								<pre>{{ $item->message }}</pre>
							</div>
						</div>
					</li>
					@elseif(get_class($item) == "App\PlayerWarning")
					<li class="timeline">
						<div class="timeline-badge warning"><i class="fa fa-comment fa-fw"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">{{ ucfirst(trans('app.warned')) }}</h4>
								<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $item->created_at->diffForHumans() }}</small>
									<small class="text-muted"><i class="glyphicon glyphicon-user"></i> {{ $item->actor->name }}</small></p>
								</div>
								<div class="timeline-body">
									<pre>{{ $item->reason }}</pre>
								</div>
							</div>
						</li>
						@elseif(get_class($item) == "App\PlayerKick")
						<li class="timeline">
							<div class="timeline-badge info"><i class="fa fa-gavel fa-fw"></i></div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">{{ trans('app.kicked') }}</h4>
									<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $item->created_at->diffForHumans() }}</small>
										<small class="text-muted"><i class="glyphicon glyphicon-user"></i> {{ $item->actor->name }}</small></p>
									</div>
									<div class="timeline-body">
										@if($item->reason)
										{{ ucfirst(trans('app.reason')) }}: {{ $item->reason }}
										@endif
									</div>
								</div>
							</li>
							@endif