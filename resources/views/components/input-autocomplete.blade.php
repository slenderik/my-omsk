<div>
    <x-text-input id="{{ $inputId }}" name="{{ $inputId }}" type="text" class="mt-1 block w-full" />
    <ul id="{{ $suggestionId }}" class="list-group"></ul>
    <x-input-error :messages="$errors->get('{{ $inputId }}')" class="mt-2" />
</div>

@push('body-scripts')
<script>
    $(document).ready(function() {
        $('#{{ $inputId }}').on('input', function() {
            let query = $(this).val();

            if (query !== '') {
                $.ajax({
                    url: '{{ $url }}',
                    type: 'GET',
                    data: { query: query },
                    success: function(data) {
                        let suggestions = $('#{{ $suggestionId }}');
                        suggestions.empty();

                        if (data.length === 0) {
                            suggestions.append('<li class="list-group-item">Нет результаторв. Нажмите Enter чтобы создать новый '+ $(this).val() + '.</li>');
                        } else {
                            $.each(data, function(key, value) {
                                suggestions.append('<li class="list-group-item" id=' + value.id + '>' + value.name + '</li>');
                            });
                        }
                    }
                });
            } else {
                $('#{{ $suggestionId }}').empty();
            }
        });

        $('#{{ $inputId }}').on('keypress', function(e) {
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
                        $('#{{ $suggestionId }}').empty();
                        alert('Item created: ' + data.name);
                    }
                });
            }
        });

        $(document).on('click', '.list-group-item', function() {
            $('#{{ $inputId }}').val($(this).text());
            $('#{{ $inputId }}').value = $(this).attr('id');
            $('#{{ $suggestionId }}').empty();
        });
    });
</script>
@endpush
