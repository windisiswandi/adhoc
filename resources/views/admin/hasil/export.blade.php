<table>
    <thead>
    <tr>
        <th>No</th>
        <th>No Pendaftaran</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Wilayah</th>
        <th>Nilai Pilihan Ganda</th>
    </tr>
    </thead>
    <tbody>
        @forelse ($hasil as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->no_pendaftaran }}</td>
            <td>{{ $item->nama_peserta }}</td>
            <td>{{ $item->nama_kelas }}</td>
            <td>{{ $item->wilayah }}</td>
            <td>{{ Crypt::decrypt($item->nilai_pilihan_ganda) }}</td>
        </tr>
        @empty
            <td>Data tidak ditemukan</td>
        @endforelse
    </tbody>
</table>
