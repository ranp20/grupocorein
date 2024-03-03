@foreach($sitemaps as $key => $sitemap)
<tr>
  <td>{{ $sitemap->id }}</td>
  <td>{{ $sitemap->sitemap_name }}</td>
  <td>
    <div class="dropdown">
      <button class="btn btn-{{  $sitemap->sitemap_status == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{  $sitemap->sitemap_status == 1 ? __('Enabled') : __('Disabled')  }}
      </button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('back.sitemap.status', [$sitemap->id, 1]) }}">{{ __('Enable') }}</a>
        <a class="dropdown-item" href="{{ route('back.sitemap.status', [$sitemap->id, 0]) }}">{{ __('Disable') }}</a>
      </div>
    </div>
  </td>
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm " href="{{ route('back.sitemap.edit', $sitemap->id) }}">
        <i class="fas fa-edit"></i>
      </a>
      <a class="btn btn-danger btn-sm " data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.sitemap.delete', $sitemap->id) }}">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </td>
</tr>
@endforeach