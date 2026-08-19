@extends('layouts.ujikom')

@section('content')
<div style="width: 100%; padding: 24px 16px;">
    <div style="max-width: 900px; margin: 0 auto; background: #ffffff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; padding: 32px; position: relative;">
        
        <!-- Header Top: Judul, Timer & Tombol Akhiri Ujian -->
        <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;">
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: #111827; margin: 0; letter-spacing: -0.025em;">{{ $jadwal->skema->nama_skema ?? 'Ujian Kompetensi' }}</h2>
            </div>
            
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Indikator Waktu -->
                <div style="display: flex; align-items: center; gap: 8px; background: #f9fafb; border: 1px solid #e5e7eb; padding: 8px 14px; border-radius: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px; color: #6b7280; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span style="font-size: 10px; color: #9ca3af; display: block; line-height: 1; margin-bottom: 2px;">Sisa Waktu</span>
                        <span id="timer" style="font-weight: 700; color: #374151; font-size: 13px;">{{ intval($ujian->waktu_selesai->diffInSeconds(now()) / 3600) }}:{{ str_pad(intval(($ujian->waktu_selesai->diffInSeconds(now()) % 3600) / 60), 2, '0', STR_PAD_LEFT) }}:{{ str_pad($ujian->waktu_selesai->diffInSeconds(now()) % 60, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                <!-- Tombol Akhiri Ujian (Link Action Diperbaiki) -->
                <form action="{{ route('peserta.ujikom.submit') }}" method="POST" id="submit-form" style="margin: 0; display: inline;">
                    @csrf
                    <button type="button" onclick="confirmSubmit()" style="padding: 10px 16px; background: #ffffff; color: #ef4444; font-weight: 600; border-radius: 12px; font-size: 13px; border: 1px solid #fecaca; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='#ffffff'">
                        Akhiri Ujikom
                    </button>
                </form>
            </div>
        </div>

        <!-- Progress Soal -->
        <div style="margin-bottom: 24px;">
            <p style="font-size: 13px; color: #6b7280; font-weight: 500; margin: 0 0 8px 0;">Soal <span id="current-question-num">1</span> dari {{ $soals->count() }}</p>
            <div style="width: 100%; background: #f3f4f6; height: 6px; border-radius: 9999px; overflow: hidden;">
                <div id="progress-bar" style="background: #2563eb; height: 100%; width: 5%; transition: width 0.3s ease;"></div>
            </div>
        </div>

        <!-- Pertanyaan -->
        <div style="margin-bottom: 24px;" id="question-container">
            <div style="display: flex; align-items: flex-start; gap: 8px;">
                <span style="font-size: 15px; font-weight: 700; color: #111827;" id="question-number">1.</span>
                <p id="question-text" style="font-size: 15px; font-weight: 500; color: #111827; line-height: 1.5; margin: 0;"></p>
            </div>
        </div>

        <!-- Pilihan Jawaban -->
        <form id="answer-form" method="POST" action="{{ route('peserta.ujikom.submit') }}">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 32px;" id="options-container"></div>

            <!-- Tombol Navigasi Sebelumnya & Berikutnya -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 16px; padding-bottom: 24px; border-top: 1px solid #f3f4f6; margin-bottom: 24px;">
                <button type="button" id="prev-btn" style="padding: 10px 20px; background: #ffffff; color: #2563eb; border-radius: 12px; font-size: 13px; font-weight: 600; border: 1px solid #e5e7eb; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    ← Sebelumnya
                </button>
                <button type="button" id="next-btn" style="padding: 10px 24px; background: #2563eb; color: #ffffff; border-radius: 12px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(37,99,235,0.2);">
                    Berikutnya →
                </button>
            </div>

            <!-- Grid Nomor Soal di Bawah -->
            <div style="padding-top: 16px; border-top: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: flex-start; flex-wrap: wrap; gap: 8px;" id="question-grid">
                <!-- Akan diisi dengan JavaScript -->
            </div>
        </form>

    </div>
</div>

<script>
    let currentQuestion = 1;
    const soals = @json($soals->toArray());
    const totalQuestions = soals.length;
    let answers = {};

    // Initialize question grid
    function initializeGrid() {
        const grid = document.getElementById('question-grid');
        grid.innerHTML = '';
        
        soals.forEach((soal, idx) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'question-badge';
            btn.setAttribute('data-index', idx + 1);
            btn.style.cssText = `
                width: 38px; height: 38px; border-radius: 12px; 
                font-size: 13px; font-weight: 600; 
                display: flex; align-items: center; justify-content: center; 
                cursor: pointer; transition: all 0.2s;
                ${idx === 0 ? 'background: #2563eb; color: #ffffff; border: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05);' : 'background: #ffffff; color: #374151; border: 1px solid #e5e7eb;'}
            `;
            btn.textContent = idx + 1;
            btn.onclick = () => selectQuestion(idx + 1);
            grid.appendChild(btn);
        });

        if (totalQuestions > 10) {
            const dots = document.createElement('span');
            dots.style.cssText = 'display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; color: #9ca3af; font-weight: bold; font-size: 14px;';
            dots.textContent = '...';
            grid.appendChild(dots);

            const lastBtn = document.createElement('button');
            lastBtn.type = 'button';
            lastBtn.className = 'question-badge';
            lastBtn.setAttribute('data-index', totalQuestions);
            lastBtn.style.cssText = `
                width: 38px; height: 38px; border-radius: 12px; 
                font-size: 13px; font-weight: 600; 
                display: flex; align-items: center; justify-content: center; 
                cursor: pointer; transition: all 0.2s;
                background: #ffffff; color: #374151; border: 1px solid #e5e7eb;
            `;
            lastBtn.textContent = totalQuestions;
            lastBtn.onclick = () => selectQuestion(totalQuestions);
            grid.appendChild(lastBtn);
        }
    }

    function displayQuestion(index) {
        const soal = soals[index - 1];
        
        // Update question text
        document.getElementById('question-number').textContent = index + '.';
        document.getElementById('question-text').textContent = soal.pertanyaan;
        document.getElementById('current-question-num').textContent = index;

        // Update progress bar
        let progressPercent = (index / totalQuestions) * 100;
        document.getElementById('progress-bar').style.width = progressPercent + '%';

        // Update options
        const optionsContainer = document.getElementById('options-container');
        optionsContainer.innerHTML = '';

        const options = ['A', 'B', 'C', 'D'];
        options.forEach(opt => {
            const pilihan = soal.pilihan_jawaban.find(p => p.pilihan === opt);
            if (pilihan) {
                const label = document.createElement('label');
                label.style.cssText = `
                    display: flex; align-items: center; padding: 14px 16px; 
                    border: 1px solid #e5e7eb; border-radius: 16px; 
                    cursor: pointer; transition: all 0.2s;
                `;
                
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = `jawaban[${soal.id}]`;
                input.value = opt;
                input.style.cssText = 'width: 16px; height: 16px; accent-color: #2563eb; cursor: pointer;';
                
                // Restore saved answer
                if (answers[soal.id] === opt) {
                    input.checked = true;
                    label.style.borderColor = '#93c5fd';
                    label.style.background = '#ebf3fe';
                }

                input.onchange = () => {
                    answers[soal.id] = opt;
                    // Update all labels styling
                    document.querySelectorAll('label[data-soal="' + soal.id + '"]').forEach(l => {
                        l.style.borderColor = '#e5e7eb';
                        l.style.background = 'transparent';
                    });
                    label.style.borderColor = '#93c5fd';
                    label.style.background = '#ebf3fe';
                };

                const span = document.createElement('span');
                span.style.cssText = 'margin-left: 12px; color: #1f2937; font-size: 14px;';
                span.textContent = opt + '. ' + pilihan.isi;

                label.setAttribute('data-soal', soal.id);
                label.appendChild(input);
                label.appendChild(span);
                optionsContainer.appendChild(label);
            }
        });

        // Update button text for last question
        const nextBtn = document.getElementById('next-btn');
        if (index === totalQuestions) {
            nextBtn.textContent = 'Selesai & Kumpulkan';
            nextBtn.style.background = '#10b981';
            nextBtn.onclick = () => confirmSubmit();
        } else {
            nextBtn.textContent = 'Berikutnya →';
            nextBtn.style.background = '#2563eb';
            nextBtn.onclick = () => {
                if (currentQuestion < totalQuestions) {
                    selectQuestion(currentQuestion + 1);
                }
            };
        }

        // Update previous button
        const prevBtn = document.getElementById('prev-btn');
        if (index === 1) {
            prevBtn.disabled = true;
            prevBtn.style.opacity = '0.5';
            prevBtn.style.cursor = 'not-allowed';
        } else {
            prevBtn.disabled = false;
            prevBtn.style.opacity = '1';
            prevBtn.style.cursor = 'pointer';
            prevBtn.onclick = () => {
                if (currentQuestion > 1) {
                    selectQuestion(currentQuestion - 1);
                }
            };
        }

        // Update question badges
        document.querySelectorAll('.question-badge').forEach(btn => {
            const idx = parseInt(btn.getAttribute('data-index'));
            if (idx === currentQuestion) {
                btn.style.background = '#2563eb';
                btn.style.color = '#ffffff';
                btn.style.border = 'none';
                btn.style.boxShadow = '0 1px 2px rgba(0,0,0,0.05)';
            } else {
                btn.style.background = '#ffffff';
                btn.style.color = '#374151';
                btn.style.border = '1px solid #e5e7eb';
                btn.style.boxShadow = 'none';
            }
        });
    }

    function selectQuestion(num) {
        currentQuestion = num;
        displayQuestion(num);
    }

    function confirmSubmit() {
        if (confirm('Apakah Anda yakin ingin mengakhiri dan mengumpulkan jawaban ujian ini?')) {
            // Add all answers to form
            const form = document.getElementById('answer-form');
            soals.forEach(soal => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `jawaban[${soal.id}]`;
                input.value = answers[soal.id] || '';
                form.appendChild(input);
            });
            form.submit();
        }
    }

    // Timer mundur otomatis
    function updateTimer() {
        const waktuSelesai = new Date(@json($ujian->waktu_selesai->timestamp * 1000));
        const updateTimerDisplay = () => {
            const now = new Date();
            const diff = waktuSelesai - now;
            
            if (diff <= 0) {
                document.getElementById('timer').textContent = '00:00:00';
                return;
            }

            let hours = Math.floor(diff / (1000 * 60 * 60));
            let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            document.getElementById('timer').textContent = 
                String(hours).padStart(2, '0') + ':' + 
                String(minutes).padStart(2, '0') + ':' + 
                String(seconds).padStart(2, '0');
        };

        updateTimerDisplay();
        setInterval(updateTimerDisplay, 1000);
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        initializeGrid();
        selectQuestion(1);
        updateTimer();
    });
</script>
@endsection