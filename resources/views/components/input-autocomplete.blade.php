<div>
    <div>
        <x-text-input id="select-search" type="text" class="mt-1 block w-full" />
        <select id="{{ $inputId }}" name="{{ $inputId }}" class="list-group"></select>
    </div>
    <x-input-error :messages="$errors->get('{{ $inputId }}')" class="mt-2" />
</div>

@push('body-scripts')
<script>
    $(document).ready(function() {
        $('#select-search').on('input', function() {
            let query = $(this).val();

            if (query !== '') {
                $.ajax({
                    url: '{{ $url }}',
                    type: 'GET',
                    data: { query: query },
                    success: function(data) {
                        let selectMenu = $('#{{ $inputId }}');
                        selectMenu.empty();

                        if (data.length === 0) {
                            selectMenu.append('<option class="list-group-item">Нет результатов, нажмите Enter чтобы создать новый элемент.</option>');
                        } else {
                            $.each(data, function(key, value) {
                                selectMenu.append('<option class="list-group-item" value='+ value.id +'>' + value.name + '</option>');
                            });
                        }
                    }
                });
            } else {
                $('#{{ $inputId }}').empty();
            }
        });

        $('#select-search').on('keypress', function(e) {
            if (e.which == 13) {
                let itemName = $(this).val();
                $.ajax({
                    url: '{{ $url }}',
                    type: 'POST',
                    data: {
                        name: itemName,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#{{ $inputId }}').empty();
                        alert('Создан: ' + data.name);
                    }
                });
            }
        });
    });
</script>
@endpush
