<table class="detail-table-weekly table table-bordered">
    <thead>
        <tr>
            <th>
                Project
            </th>
            <th>
                Employee
            </th>
            <th>
                Company
            </th>
            <th>
                Start Date
            </th>
            <th>
                End Date
            </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($datas))
            @foreach ($datas as $key => $row)
                <tr>
                    <td>
                        {{ $row->project_name }}
                    </td>
                    <td>
                        {{ $row->user_name }}
                    </td>
                    <td>
                        {{ $row->company_name }}
                    </td>
                    <td>
                        {{ $row->start_date }}
                    </td>
                    <td>
                        {{ $row->end_date }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">
                    Data Not Found
                </td>
            </tr>
        @endif
    </tbody>
</table>
