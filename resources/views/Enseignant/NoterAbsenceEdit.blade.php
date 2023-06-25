@extends('layouts.enseignant')

@section('content')
<section class="features text-center" style="min-height:70vh">
   <div class="container">
    @error('absence.*.etat')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <form action="{{ route('edit.absence') }}" method="post">
        @csrf
        <table class="table table-striped table">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Etat <br> Present(e) - Absent(e) </th>
                    <th scope="col">Justification</th>
                </tr>
            </thead>
            <tbody>
                @isset($etudiants)
                @foreach ($etudiants as $key => $e)
                <tr>
                    <input type="hidden" name="absence[{{$key}}][id_etu]" value="{{$e->id_etudiant}}">
                    <td>{{ $e->nom_etu }}</td>
                    <td>{{ $e->prenom_etu }}</td>
                    <td class="md-lg">
                        <div class="radio form-check-inline">
                            <input type="radio" class="form-check-input" name="absence[{{$key}}][etat]" value="0" {{ $e->etat == 0 ? 'checked' : '' }}>
                        </div>
                        <div class="radio form-check-inline">
                            <input type="radio" class="form-check-input" name="absence[{{$key}}][etat]" value="1" {{ $e->etat == 1 ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <select class="form-control" name="absence[{{$key}}][justification]">
                                <option value="Non Justifie" {{ $e->justification == 'Non Justifie' ? 'selected' : '' }}>Non Justifie</option>
                                <option value="Justifie" {{ $e->justification == 'Justifie' ? 'selected' : '' }}>Justifie</option>
                            </select>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endisset
                <input type="hidden" name="id_sea" value="{{ $seance->id_seance }}">
            </tbody>
        </table>
        <input type="submit" class="btn btn-primary btn-lg" value="submit">
    </form>
</div>
</section>
@endsection
