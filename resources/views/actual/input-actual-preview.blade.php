<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-y-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
        <div class="flex flex-col items-center justify-center">
            <div class="">
                <span class="text-center font-bold text-2xl">Key Performance Indicator</span>
            </div>
            <div class="">
                <span class="text-center font-bold text-xl">Periode 1 - 2025</span>
            </div>    
        </div>
        <div class="p-1 grid grid-cols-4 mt-2">
            <div class="mx-1">
                <table class="table-auto">
                    <tr>
                        <td class="text-gray-600 text-[11px] font-medium">Dept</td>
                        <td style="width: 2%;" class="text-gray-600 text-[11px] text-center font-medium">:</td>
                        <td class="text-gray-600 text-[11px] font-medium">{{ $previews->first()->department }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-600 text-[11px] font-medium">NIK</td>
                        <td style="width: 20%;" class="text-gray-600 text-[11px] text-center font-medium">:</td>
                        <td class="text-gray-600 text-[11px] font-medium">{{ $previews->first()->nik }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-600 text-[11px] font-medium">Nama</td>
                        <td style="width: 20%;" class="text-gray-600 text-[11px] text-center font-medium">:</td>
                        <td class="text-gray-600 text-[11px] font-medium">{{ $previews->first()->employee }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-600 text-[11px] font-medium">Posisi</td>
                        <td style="width: 20%;" class="text-gray-600 text-[11px] text-center font-medium">:</td>
                        <td class="text-gray-600 text-[11px] font-medium">{{ $previews->first()->occupation }}</td>
                    </tr>
                    
                </table>
            </div>
            <div class="">
                <table>
                    <tr>
                        <td style="width: 20%;" class="text-gray-600 text-[11px] font-medium">KPI</td>
                        <td style="width: 10%;" class="text-gray-600 text-[11px] text-center font-medium">:</td>
                        <td style="width: 70%" class="text-gray-600 text-[11px] font-medium">{{ $previews->first()->kpi_item }}</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;" class="text-gray-600 text-[11px] font-medium">NO. KPI</td>
                        <td style="width: 10%;" class="text-gray-600 text-[11px] text-center font-medium">:</td>
                        <td style="width: 70%" class="text-gray-600 text-[11px] font-medium">{{ $previews->first()->kpi_code }}</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;" class="text-gray-600 text-[11px] font-medium">Periode Review</td>
                        <td style="width: 10%;" class="text-gray-600 text-[11px] text-center font-medium">:</td>
                        <td style="width: 70%" class="text-gray-600 text-[11px] font-medium">{{ $previews->first()->review_period }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <table class="w-full mt-2 table-auto">
            <thead>
                <tr>
                    <th style="width: 3%;" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">No.</th>
                    <th style="width: 12%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Bulan</th>
                    <th style="width: 7%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Unit</th>
                    <th style="width: 7%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Bobot "%"</th>
                    <th style="width: 7%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Target</th>
                    <th style="width: 7%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Actual</th>
                    <th style="width: 4%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">%</th>
                    <th style="width: 7%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Bobot Pencapaian "%"</th>
                    <th style="width: 7%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Data Pendukung</th>
                    <th style="width: 30%" class="border-2 border-gray-400 text-[11px] uppercase tracking-wide font-medium text-gray-600 bg-yellow-200">Komentar</th>
                </tr>
            </thead>
            <tbody id="bulanTableBody">
                    
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bulanTableBody = document.getElementById('bulanTableBody');
            const idEmployee = @json($id_employee);
            const kpiCode = @json($kpi_code)
    
            function determineSemester() {
                const currentMonth = new Date().getMonth() + 1;
                let semester;
                let bulanOptions;
    
                if (currentMonth == 2 && currentMonth < 8) {
                    semester = 'Ganjil';
                    bulanOptions = ['01', '02', '03', '04', '05', '06'];
                } else {
                    semester = 'Genap';
                    bulanOptions = ['07', '08', '09', '10', '11', '12'];
                }
    
                bulanTableBody.innerHTML = '';
                bulanOptions.forEach((bulan, index) => {
                    const row = `<tr>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2 text-center">${index + 1}</td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2">${convertMonthToName(bulan)}</td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2" id="data-${bulan.toLowerCase()}-unit"></td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2 text-right" id="data-${bulan.toLowerCase()}-weighting"></td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2 text-right" id="data-${bulan.toLowerCase()}-target"></td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2 text-right" id="data-${bulan.toLowerCase()}-actual"></td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2 text-right" id="data-${bulan.toLowerCase()}-percentage"></td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2 text-center" id="data-${bulan.toLowerCase()}-achievement"></td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2 text-center" id="data-${bulan.toLowerCase()}-supporting_document"></td>
                        <td class="border-2 py-1 border-gray-400 text-[10px] tracking-wide py-0 px-2" id="data-${bulan.toLowerCase()}-comment"></td>
                    </tr>`;
                    bulanTableBody.innerHTML += row;
                });
    
                return semester;
            }
    
            function convertMonthToName(month) {
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                return monthNames[parseInt(month) - 1];
            }
    
            function fetchData(semester) {
                const bulanOptions = semester === 'Ganjil' ? ['01', '02', '03', '04', '05', '06'] : ['07', '08', '09', '10', '11', '12'];
    
                bulanOptions.forEach(bulan => {
                    // Ganti URL dengan endpoint yang sesuai untuk mendapatkan data berdasarkan semester dan bulan
                    fetch(`{{ url('actual/preview/${idEmployee}/${kpiCode}/filter') }}?semester=${semester}&bulan=${bulan}`)
                        .then(response => response.json()) // Ubah menjadi JSON
                        .then(data => {
                            if (data.length > 0) {
                                data.forEach(item => {
                                    const percentage = parseFloat(item.kpi_percentage);
                                    const weighting = parseFloat(item.kpi_weighting);
                                    const achievement = (weighting / percentage) * 100;
    
                                    document.getElementById(`data-${bulan}-unit`).innerHTML = item.kpi_unit;
                                    document.getElementById(`data-${bulan}-weighting`).innerHTML = item.kpi_weighting;
                                    document.getElementById(`data-${bulan}-target`).innerHTML = item.target;
                                    document.getElementById(`data-${bulan}-actual`).innerHTML = item.actual;
                                    document.getElementById(`data-${bulan}-percentage`).innerHTML = item.kpi_percentage;
                                    document.getElementById(`data-${bulan}-achievement`).innerHTML = parseInt(achievement) + '%';
                                    document.getElementById(`data-${bulan}-supporting_document`).innerHTML = item.record_file ? 'Yes' : 'No';
                                    document.getElementById(`data-${bulan}-comment`).innerHTML = item.comment;
                                });
                            } else {
                                document.getElementById(`data-${bulan}-unit`).innerHTML = '';
                                document.getElementById(`data-${bulan}-weighting`).innerHTML = '';
                                document.getElementById(`data-${bulan}-target`).innerHTML = '';
                                document.getElementById(`data-${bulan}-actual`).innerHTML = '';
                                document.getElementById(`data-${bulan}-percentage`).innerHTML = '';
                                document.getElementById(`data-${bulan}-achievement`).innerHTML = '';
                                document.getElementById(`data-${bulan}-supporting_document`).innerHTML = 'No';
                                document.getElementById(`data-${bulan}-comment`).innerHTML = '';
                            }
                        })
                        .catch(error => console.error('Error parsing JSON:', error));
                });
            }
    
            const semester = determineSemester();
            fetchData(semester);
        });
    </script>
</x-app-layout>