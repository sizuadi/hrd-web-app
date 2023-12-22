<table class="detail-table-weekly table table-bordered">
    <thead>
        <tr>
            <th>
                Project - Employee
            </th>
            <th>
                Module
            </th>
            <th>
                Day
            </th>
            <th>
                Hour
            </th>
            <th>
                Total Hour
            </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($datas))
            @foreach ($datas as $key => $row)
                @php
                    $module = json_decode($row->module);
                    $row->module = $module->module;
                    $row->link = $module->link;
                    $row->description = $module->description;
                @endphp
                <tr>
                    <td>
                        {{ $row->project_name }} - {{ $row->user_name }}
                    </td>
                    <td>
                        Module : {{ $row->module }} <br>
                        Link : {{ $row->link }} <br>
                        Description : {{ $row->description }}
                    </td>
                    <td>
                        {{ $row->day }}
                    </td>
                    <td>
                        {{ $row->hour }}
                    </td>
                    <td>
                        {{ $row->total_hour }}
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
