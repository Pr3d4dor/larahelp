<div>
    <form role="form" action="{{ $user->exists
        ? route('admin.users.update', ['user' => $user->getKey()])
        : route('admin.users.store') }}"
        method="POST"
    >
        @method($user->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nome</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="João Silva" value="{{ $user->name ?? old('name') }}" autofocus>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="joao_silva@email.com" value="{{ $user->email ?? old('email') }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Senha">
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Repita a Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="Senha">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
