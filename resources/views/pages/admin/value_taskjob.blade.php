<table class="table table-striped table-responsive" id="table-taskjob">
    <thead>
        <th></th>
        <th>No</th>
        <th>Code Name</th>
        <th>Jobdesk</th>
        <th>Cost Estimation</th>
        <th>Freq Interval</th>
        <th>Start Hour</th>
        <th>Running Hour</th>
        <th>Left Hour</th>
        <th>Total Hour</th>
        <th>Plane</th>
        <th>Notification</th>
        <th>Status</th>
    </thead>
    <tfoot>
        <th></th>
        <th>No</th>
        <th>Code Name</th>
        <th>Jobdesk</th>
        <th>Cost Estimation</th>
        <th>Freq Interval</th>
        <th>Start Hour</th>
        <th>Running Hour</th>
        <th>Left Hour</th>
        <th>Total Hour</th>
        <th>Plane</th>
        <th>Notification</th>
        <th>Status</th>
    </tfoot>
    <tbody>
        @foreach ($taskjob as $t)
            <tr>
                <td></td>
                <td>{{ $t->id_barang }}</td>
                <td>{{ $t->id_barang . ' ' . $t->name }}</td>
                <td>{{ $t->job_desk }}</td>
                <td>{{ $t->price }}</td>
                <td>{{ $t->freq . ' ' . $t->periode }}</td>
                <td>{{ $t->start_hour }}</td>
                <td>{{ $t->running_hour }}</td>
                <td>{{ $t->left_hour }}</td>
                <td>{{ $t->total_hour }}</td>
                <td>{{ $t->date_plan }}</td>
                <td>
                    @if ($t->periode == 'Days' || $t->periode == 'Month' || $t->periode == 'Year')

                        <p
                            class="{{ \Carbon\Carbon::parse($t->date_plan)->diffInDays(now(), false) >= 0 ? 'text-danger' : 'text-success' }}">
                            {{ \Carbon\Carbon::parse($t->date_plan)->diffInDays(now(), false) }}
                            Days
                        </p>
                    @else
                        <p
                            class="{{ \Carbon\Carbon::parse($t->date_plan)->diffInMinutes(now(), false) >= 0 ? 'text-danger' : 'text-success' }}">
                            {{ \Carbon\Carbon::parse($t->date_plan)->diffInMinutes(now(), false) }}
                            Minutes
                        </p>
                    @endif
                </td>
                <td>
                    <p class="btn btn-sm {{ $t->status_action == 1 ? 'btn-success' : 'btn-danger' }}">
                        {{ $t->status_action == 1 ? 'Yes' : 'not' }}</p>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
