@extends('layouts.template')

@section('title'){{ 'Dashboard' }}@endsection

@section('content')
    <div class="container bg-white card">
        <div class="display-4 py-3 text-center">
            Dashboard
        </div>
        <div class="row text-center">
            <div class="col-lg-6">
                <h4>Authors</h4>
                <table class="table table-striped table-dark table-bordered">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Photo
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Books
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>
                                    {{ $author->id }}
                                </td>
                                <td>
                                    <img width="30px" class="img-thumbnail"
                                        src="{{ route('authors.index') . '/photos/' . $author->photo }}"
                                        alt="{{ $author->name }}">
                                </td>
                                <td>
                                    {{ $author->name }}
                                </td>
                                <td>
                                    {{ count($author->books) }}
                                </td>
                                <td>
                                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('authors.destroy', $author->id) }}" class="d-inline">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <h4>Books</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Cover
                            </th>
                            <th>
                                Title
                            </th>
                            <th>
                                Author
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>
                                    {{ $book->id }}
                                </td>
                                <td>
                                    <img width="40px" class="img-thumbnail"
                                        src="{{ route('books.index') . '/cover/' . $book->cover }}"
                                        alt="{{ $book->title }}">
                                </td>
                                <td>
                                    {{ $book->title }}
                                </td>
                                <td>
                                    {{ $book->author->name }}
                                </td>
                                <td>
                                    @if ($book->pdf)
                                        <a href="" class="btn btn-success btn-sm"><i class="fas fa-cloud-download-alt"></i>
                                            PDF</a>
                                    @else
                                        <button disabled class="btn btn-light border btn-sm"><i class="fas fa-times"></i>
                                            no PDF</button>
                                    @endif
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <form method="POST" action="{{ route('books.destroy', $book->id) }}" class="d-inline">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
