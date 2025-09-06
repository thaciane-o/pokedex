@props([
  'head',
  'body',
  'route',
  'id' => 'tabela-padrao'
])

<div class="table-responsive">
  <table class="table table-striped align-middle" id="{{ $id }}">
    <thead class="table-light">
      <tr>
        @foreach ($head as $name)
          <th>{{ $name }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

@push('scripts')
<script>
  $(function () {
    $('#{{ $id }}').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      stateSave: true,
      order: [[0, 'desc']],
      ajax: '{{ route($route) }}',
      columns: @json($body),
      language: {
        url: '{{asset("pt-BR.json")}}'
      },
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
    });
  });
</script>
@endpush
