<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>カナ名</th>
            <th>所属</th>
            <th>登録日時</th>
            <th>更新日時</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>

                {{ $user->id }}</td>
            <td>

                {{ $user->getName() }}
            </td>
            <td>

                {{ $user->getNameKana() }}
            </td>
            <td>

                {{ $user->school->getName() }}
            </td>
            <td>

                {{ $user->created_at }}</td>
            <td>

                {{ $user->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
