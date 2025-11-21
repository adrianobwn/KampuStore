<h1>Verifikasi Seller</h1>

@if(session('success'))
  <div style="color:green;">{{ session('success') }}</div>
@endif

<h2>Pending</h2>
<table border="1" cellpadding="6">
  <tr>
    <th>Nama Toko</th>
    <th>PIC</th>
    <th>Email</th>
    <th>Aksi</th>
  </tr>
  @forelse($pending as $s)
    <tr>
      <td>{{ $s->nama_toko }}</td>
      <td>{{ $s->nama_pic }}</td>
      <td>{{ $s->email_pic }}</td>
      <td>
        <form action="{{ route('admin.sellers.approve', $s) }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit">Approve</button>
        </form>
        <form action="{{ route('admin.sellers.reject', $s) }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit">Reject</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="4">Tidak ada pengajuan pending.</td></tr>
  @endforelse
</table>
