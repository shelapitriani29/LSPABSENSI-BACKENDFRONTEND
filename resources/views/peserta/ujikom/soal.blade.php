@extends('layouts.peserta')

@section('content')
<div style="width: 100%; padding: 24px 16px;">
    <div style="max-width: 900px; margin: 0 auto; background: #ffffff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; padding: 32px; position: relative;">
        
        <!-- Header Top: Judul, Timer & Tombol Akhiri Ujian -->
        <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;">
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: #111827; margin: 0; letter-spacing: -0.025em;">Teknisi Instalasi Energi Terbarukan</h2>
            </div>
            
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Indikator Waktu -->
                <div style="display: flex; align-items: center; gap: 8px; background: #f9fafb; border: 1px solid #e5e7eb; padding: 8px 14px; border-radius: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px; color: #6b7280; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span style="font-size: 10px; color: #9ca3af; display: block; line-height: 1; margin-bottom: 2px;">Sisa Waktu</span>
                        <span id="timer" style="font-weight: 700; color: #374151; font-size: 13px;">00:58:42</span>
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
            <p style="font-size: 13px; color: #6b7280; font-weight: 500; margin: 0 0 8px 0;">Soal <span id="current-question-num">1</span> dari 20</p>
            <div style="width: 100%; background: #f3f4f6; height: 6px; border-radius: 9999px; overflow: hidden;">
                <div id="progress-bar" style="background: #2563eb; height: 100%; width: 5%; transition: width 0.3s ease;"></div>
            </div>
        </div>

        <!-- Pertanyaan -->
        <div style="margin-bottom: 24px;">
            <div style="display: flex; align-items: flex-start; gap: 8px;">
                <span style="font-size: 15px; font-weight: 700; color: #111827;">1.</span>
                <p id="question-text" style="font-size: 15px; font-weight: 500; color: #111827; line-height: 1.5; margin: 0;">
                    Komponen yang berfungsi untuk mengubah energi cahaya matahari menjadi energi listrik pada sistem PLTS adalah ...
                </p>
            </div>
        </div>

        <!-- Pilihan Jawaban -->
        <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 32px;" id="options-container">
            <label style="display: flex; align-items: center; padding: 14px 16px; border: 1px solid #e5e7eb; border-radius: 16px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='#93c5fd'; this.style.background='#f9fafb'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.background='transparent'">
                <input type="radio" name="jawaban" value="A" style="width: 16px; height: 16px; accent-color: #2563eb; cursor: pointer;">
                <span style="margin-left: 12px; color: #1f2937; font-size: 14px;">A. Inverter</span>
            </label>
            
            <label id="opt-b-label" style="display: flex; align-items: center; padding: 14px 16px; border: 1px solid #93c5fd; background: #ebf3fe; border-radius: 16px; cursor: pointer; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
                <input type="radio" name="jawaban" value="B" checked style="width: 16px; height: 16px; accent-color: #2563eb; cursor: pointer;">
                <span style="margin-left: 12px; color: #111827; font-size: 14px; font-weight: 500;">B. Panel Surya</span>
            </label>

            <label style="display: flex; align-items: center; padding: 14px 16px; border: 1px solid #e5e7eb; border-radius: 16px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='#93c5fd'; this.style.background='#f9fafb'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.background='transparent'">
                <input type="radio" name="jawaban" value="C" style="width: 16px; height: 16px; accent-color: #2563eb; cursor: pointer;">
                <span style="margin-left: 12px; color: #1f2937; font-size: 14px;">C. Baterai</span>
            </label>

            <label style="display: flex; align-items: center; padding: 14px 16px; border: 1px solid #e5e7eb; border-radius: 16px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='#93c5fd'; this.style.background='#f9fafb'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.background='transparent'">
                <input type="radio" name="jawaban" value="D" style="width: 16px; height: 16px; accent-color: #2563eb; cursor: pointer;">
                <span style="margin-left: 12px; color: #1f2937; font-size: 14px;">D. SCC (Solar Charge Controller)</span>
            </label>
        </div>

        <!-- Tombol Navigasi Sebelumnya & Berikutnya -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 16px; padding-bottom: 24px; border-top: 1px solid #f3f4f6; margin-bottom: 24px;">
            <button id="prev-btn" style="padding: 10px 20px; background: #ffffff; color: #2563eb; border-radius: 12px; font-size: 13px; font-weight: 600; border: 1px solid #e5e7eb; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                ← Sebelumnya
            </button>
            <button id="next-btn" style="padding: 10px 24px; background: #2563eb; color: #ffffff; border-radius: 12px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(37,99,235,0.2);">
                Berikutnya →
            </button>
        </div>

        <!-- Grid Nomor Soal di Bawah -->
        <div style="padding-top: 16px; border-top: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: flex-start; flex-wrap: wrap; gap: 8px;">
            @for ($i = 1; $i <= 10; $i++)
                <button onclick="selectQuestion({{ $i }})" 
                    class="question-badge"
                    data-index="{{ $i }}"
                    style="width: 38px; height: 38px; border-radius: 12px; font-size: 13px; font-weight: 600; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;
                    {{ $i === 1 ? 'background: #2563eb; color: #ffffff; border: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05);' : 'background: #ffffff; color: #374151; border: 1px solid #e5e7eb;' }}">
                    {{ $i }}
                </button>
            @endfor
            
            <span style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; color: #9ca3af; font-weight: bold; font-size: 14px;">...</span>
            
            <button onclick="selectQuestion(20)" 
                class="question-badge"
                data-index="20"
                style="width: 38px; height: 38px; border-radius: 12px; font-size: 13px; font-weight: 600; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; background: #ffffff; color: #374151; border: 1px solid #e5e7eb;">
                20
            </button>
        </div>

    </div>
</div>

<script>
    let currentQuestion = 1;
    const totalQuestions = 20;

    function selectQuestion(num) {
        currentQuestion = num;
        document.getElementById('current-question-num').innerText = num;
        
        let progressPercent = (num / totalQuestions) * 100;
        document.getElementById('progress-bar').style.width = progressPercent + '%';
        
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

    document.getElementById('next-btn').addEventListener('click', () => {
        if (currentQuestion < totalQuestions) {
            selectQuestion(currentQuestion + 1);
        }
    });

    document.getElementById('prev-btn').addEventListener('click', () => {
        if (currentQuestion > 1) {
            selectQuestion(currentQuestion - 1);
        }
    });

    function confirmSubmit() {
        if (confirm('Apakah Anda yakin ingin mengakhiri dan mengumpulkan jawaban ujian ini?')) {
            document.getElementById('submit-form').submit();
        }
    }

    // Timer mundur otomatis
    let timerSeconds = 58 * 60 + 42;
    setInterval(() => {
        if (timerSeconds > 0) {
            timerSeconds--;
            let hours = Math.floor(timerSeconds / 3600);
            let minutes = Math.floor((timerSeconds % 3600) / 60);
            let seconds = timerSeconds % 60;
            document.getElementById('timer').innerText = 
                String(hours).padStart(2, '0') + ':' + 
                String(minutes).padStart(2, '0') + ':' + 
                String(seconds).padStart(2, '0');
        }
    }, 1000);
</script>
@endsection