<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Создать ивент') }}
        </h2>
    </x-slot>

    <x-jquery />

    <form action="{{ route('api.event.create') }}" method="POST" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="english_name" :value="__('Англ. название')" />
            <x-text-input id="english_name" name="english_name" type="text" class="mt-1 block w-full" placeholder="/anime"/>
            <x-input-error :messages="$errors->get('english_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="title" :value="__('Заголовок')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="Anime shop"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        
        <div>
            <x-input-label for="background_colour" :value="__('Фоновый цвет')" />
            <x-text-input id="background_colour" name="background_colour" type="color" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('background_colour')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Описание')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" placeholder="Магазин аниме аттрибутики."/>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="image" :value="__('Картинка')" />
            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="image_alt" :value="__('Описание картинки')" />
            <x-text-input id="image_alt" name="image_alt" type="text" class="mt-1 block w-full" placeholder="Женщина стоит у магазина"/>
            <x-input-error :messages="$errors->get('image_alt')" class="mt-2" />
        </div>
            
        <div>     
            <x-input-label for="organization_id" :value="__('Организация')" />
            <x-text-input
                id="select-search"
                type="text"
                class="mt-1 block w-full"
                placeholder="Поиск по названию, выбор ниже."
            />
            <select id="organization_id" name="organization_id" class="list-group">
                <option value="">Выберите организацию</option>
            </select>
            <x-input-error :messages="$errors->get('organization_id')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Добавить ивент') }}</x-primary-button>

            @if (session('status') === 'events-new')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Ивент добавлен.') }}</p>
            @endif
        </div>   
    </form>

    @push('body-scripts')
    <script>
        $(document).ready(function() {
            $('#select-search').on('input', function() {
                let query = $(this).val();

                if (query == '') {
                    $('#organization_id').empty();
                    return;
                }

                $.ajax({
                    url: '/api/organization',
                    type: 'GET',
                    data: { query: query },
                    success: function(data) {
                        let selectMenu = $('#organization_id');
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
            });

            $('#select-search').on('keypress', function(e) {
                if (e.which == 13) {
                    let itemName = $(this).val();
                    $.ajax({
                        url: '/api/organization',
                        type: 'POST',
                        data: {
                            name: itemName,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#organization_id').empty();
                            alert('Создан: ' + data.name);
                        }
                    });
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
