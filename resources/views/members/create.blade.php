<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>সদস্য নিবন্ধন ফরম - Member Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bangladesh-green: #006a4e;
            --bangladesh-red: #f42a41;
            --government-blue: #1a365d;
            --official-gold: #d4af37;
            --paper-cream: #faf8f3;
            --ink-black: #1a202c;
        }
        
        body {
            font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 106, 78, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(244, 42, 65, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        
        .main-container {
            position: relative;
            z-index: 1;
        }
        
        .government-header {
            background: linear-gradient(90deg, var(--government-blue) 0%, #2c5282 100%);
            position: relative;
            overflow: hidden;
        }
        
        .government-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--official-gold) 0%, #f4e4c1 50%, var(--official-gold) 100%);
        }
        
        .government-header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--official-gold);
        }
        
        .emblem {
            width: 60px;
            height: 60px;
            background: var(--bangladesh-red);
            border-radius: 50%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 3px var(--official-gold);
        }
        
        .emblem::before {
            content: "";
            position: absolute;
            width: 50px;
            height: 50px;
            background: var(--bangladesh-green);
            border-radius: 50%;
        }
        
        .official-stamp {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 100px;
            height: 100px;
            border: 2px solid var(--bangladesh-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-15deg);
            opacity: 0.7;
            color: var(--bangladesh-red);
            font-weight: bold;
            text-align: center;
            font-size: 12px;
            line-height: 1.2;
        }
        
        .surface-panel {
            background: var(--paper-cream);
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
            overflow: hidden;
        }
        
        .surface-panel::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--bangladesh-green) 0%, var(--bangladesh-red) 100%);
        }
        
        .section-header {
            position: relative;
            padding-left: 20px;
            margin-bottom: 20px;
        }
        
        .section-header::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: var(--government-blue);
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            font-size: 0.875rem;
            transition: all 0.2s;
            background: white;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--government-blue);
            box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--ink-black);
        }
        
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-weight: 600;
            background: linear-gradient(135deg, var(--government-blue) 0%, #2c5282 100%);
            color: white;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(26, 54, 93, 0.3);
        }
        
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-weight: 600;
            border: 2px solid var(--government-blue);
            background: white;
            color: var(--government-blue);
            transition: all 0.2s;
        }
        
        .btn-outline:hover {
            background: var(--government-blue);
            color: white;
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1;
        }
        
        .step-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #64748b;
            transition: all 0.3s;
            position: relative;
        }
        
        .step.active .step-circle {
            background: linear-gradient(135deg, var(--government-blue) 0%, #2c5282 100%);
            color: white;
            box-shadow: 0 4px 8px rgba(26, 54, 93, 0.3);
        }
        
        .step.completed .step-circle {
            background: linear-gradient(135deg, var(--bangladesh-green) 0%, #047857 100%);
            color: white;
        }
        
        .step-label {
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: #64748b;
            text-align: center;
            font-weight: 500;
        }
        
        .step.active .step-label {
            color: var(--government-blue);
            font-weight: 600;
        }
        
        .step.completed .step-label {
            color: var(--bangladesh-green);
            font-weight: 600;
        }
        
        .progress-line {
            position: absolute;
            top: 2.75rem;
            left: 10%;
            right: 10%;
            height: 2px;
            background-color: #e2e8f0;
            z-index: 0;
        }
        
        .progress-line-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--bangladesh-green) 0%, #047857 100%);
            width: 0%;
            transition: width 0.5s ease;
        }
        
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 1.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            transform: translateX(150%);
            transition: transform 0.3s ease;
            z-index: 50;
            border-left: 4px solid var(--bangladesh-green);
        }
        
        .toast.show {
            transform: translateX(0);
        }
        
        .toast.error {
            border-left-color: var(--bangladesh-red);
        }
        
        .watermark {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0.05;
            font-size: 100px;
            font-weight: bold;
            color: var(--government-blue);
            transform: rotate(-45deg);
            pointer-events: none;
            user-select: none;
        }
        
        .official-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--official-gold) 0%, #f4e4c1 100%);
            color: var(--government-blue);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 2px dashed #cbd5e0;
            border-radius: 4px;
            background: white;
            transition: all 0.2s;
            position: relative;
        }
        
        .file-upload-label:hover {
            border-color: var(--government-blue);
            background: #f0f4f8;
        }
        
        .decorative-border {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1px solid rgba(212, 175, 55, 0.3);
            pointer-events: none;
            border-radius: 4px;
        }
        
        .decorative-corner {
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid var(--official-gold);
        }
        
        .decorative-corner.top-left {
            top: 5px;
            left: 5px;
            border-right: none;
            border-bottom: none;
        }
        
        .decorative-corner.top-right {
            top: 5px;
            right: 5px;
            border-left: none;
            border-bottom: none;
        }
        
        .decorative-corner.bottom-left {
            bottom: 5px;
            left: 5px;
            border-right: none;
            border-top: none;
        }
        
        .decorative-corner.bottom-right {
            bottom: 5px;
            right: 5px;
            border-left: none;
            border-top: none;
        }
        
        @media print {
            body {
                background: white;
            }
            
            .btn-primary, .btn-outline, .step-indicator {
                display: none;
            }
            
            .surface-panel {
                box-shadow: none;
                border: 1px solid #000;
            }
        }
        
        /* .bangla-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23006a4e' fill-opacity='0.03'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");
        } */
    </style>
</head>
<body>
    <div class="main-container min-h-screen py-8">


        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                <section class="text-center">
                    
                    <h1 class="mt-4 text-3xl font-bold text-slate-900">সদস্য নিবন্ধন ফরম</h1>
                    {{-- <p class="mt-2 text-lg text-slate-600">Member Registration Form</p> --}}
                    <div class="mt-4 flex justify-center items-center space-x-8 text-sm text-slate-500">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>তারিখ: <span id="currentDate"></span></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>সময়: <span id="currentTime"></span></span>
                        </div>
                    </div>
                </section>

                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="progress-line">
                        <div class="progress-line-fill" id="progressLine"></div>
                    </div>
                    <div class="step active" data-step="1">
                        <div class="step-circle">১</div>
                        <div class="step-label">ব্যক্তিগত তথ্য</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-circle">২</div>
                        <div class="step-label">যোগাযোগ</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-circle">৩</div>
                        <div class="step-label">ঠিকানা</div>
                    </div>
                    <div class="step" data-step="4">
                        <div class="step-circle">৪</div>
                        <div class="step-label">মনোনীত ব্যক্তি</div>
                    </div>
                    <div class="step" data-step="5">
                        <div class="step-circle">৫</div>
                        <div class="step-label">সদস্যতা</div>
                    </div>
                </div>

                <form id="memberForm" method="POST" action="#" enctype="multipart/form-data" class="space-y-8">
                    <!-- Personal Details Section -->
                    <section class="surface-panel p-6 sm:p-8 space-y-6 form-section bangla-pattern" data-section="1">
                        <div class="decorative-border"></div>
                        <div class="decorative-corner top-left"></div>
                        <div class="decorative-corner top-right"></div>
                        <div class="decorative-corner bottom-left"></div>
                        <div class="decorative-corner bottom-right"></div>
                        
                        <div class="section-header">
                            <h2 class="text-xl font-bold text-slate-900">অনুচ্ছেদ ১: ব্যক্তিগত তথ্য</h2>
                            <p class="text-sm text-slate-600">Section 1: Personal Details</p>
                        </div>
                        
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="space-y-2 sm:col-span-2">
                                <label for="full_name_bn" class="form-label">পূর্ণ নাম (বাংলা) <span class="text-red-500">*</span></label>
                                <input id="full_name_bn" name="full_name_bn" required placeholder="সদস্যের পূর্ণ নাম বাংলায় লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="full_name_en" class="form-label">Full Name (English)</label>
                                <input id="full_name_en" name="full_name_en" placeholder="Enter full name in English" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="father_name" class="form-label">পিতার নাম</label>
                                <input id="father_name" name="father_name" placeholder="পিতার নাম লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="mother_name" class="form-label">মাতার নাম</label>
                                <input id="mother_name" name="mother_name" placeholder="মাতার নাম লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="spouse_name" class="form-label">স্বামী/স্ত্রীর নাম</label>
                                <input id="spouse_name" name="spouse_name" placeholder="স্বামী/স্ত্রীর নাম লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="gender" class="form-label">লিঙ্গ</label>
                                <select id="gender" name="gender" class="form-input">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="male">পুরুষ</option>
                                    <option value="female">নারী</option>
                                    <option value="other">অন্যান্য</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="dob" class="form-label">জন্ম তারিখ</label>
                                <input id="dob" type="date" name="dob" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="nid_no" class="form-label">জাতীয় পরিচয়পত্র নম্বর</label>
                                <input id="nid_no" name="nid_no" placeholder="জাতীয় পরিচয়পত্র নম্বর লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="institution_name" class="form-label">প্রতিষ্ঠানের নাম</label>
                                <input id="institution_name" name="institution_name" placeholder="প্রতিষ্ঠানের নাম লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="religion" class="form-label">ধর্ম</label>
                                <select id="religion" name="religion" class="form-input">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="islam">ইসলাম</option>
                                    <option value="hindu">হিন্দু</option>
                                    <option value="buddhist">বৌদ্ধ</option>
                                    <option value="christian">খ্রিস্টান</option>
                                    <option value="other">অন্যান্য</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="nationality" class="form-label">জাতীয়তা</label>
                                <input id="nationality" name="nationality" value="বাংলাদেশী" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="blood_group" class="form-label">রক্তের গ্রুপ</label>
                                <select id="blood_group" name="blood_group" class="form-input">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex justify-end pt-4">
                            <button type="button" class="btn-primary next-section" data-next="2">
                                পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </section>

                    <!-- Contact Information Section -->
                    <section class="surface-panel p-6 sm:p-8 space-y-6 form-section hidden" data-section="2">
                        <div class="decorative-border"></div>
                        <div class="section-header">
                            <h2 class="text-xl font-bold text-slate-900">অনুচ্ছেদ ২: যোগাযোগের তথ্য</h2>
                            <p class="text-sm text-slate-600">Section 2: Contact Information</p>
                        </div>
                        
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="mobile" class="form-label">মোবাইল নম্বর <span class="text-red-500">*</span></label>
                                <input id="mobile" name="mobile" required placeholder="০১XXXXXXXXX" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="form-label">ইমেইল ঠিকানা</label>
                                <input id="email" type="email" name="email" placeholder="example@email.com" class="form-input">
                            </div>
                            <div class="space-y-2 sm:col-span-2">
                                <label for="occupation" class="form-label">পেশা</label>
                                <input id="occupation" name="occupation" placeholder="আপনার পেশা লিখুন" class="form-input">
                            </div>
                        </div>
                        
                        <div class="flex justify-between pt-4">
                            <button type="button" class="btn-outline prev-section" data-prev="1">
                                <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                            </button>
                            <button type="button" class="btn-primary next-section" data-next="2">
                                পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </section>

                    <!-- Address Section -->
                    <section class="surface-panel p-6 sm:p-8 space-y-6 form-section hidden" data-section="3">
                        <div class="decorative-border"></div>
                        <div class="section-header">
                            <h2 class="text-xl font-bold text-slate-900">অনুচ্ছেদ ৩: ঠিকানা</h2>
                            <p class="text-sm text-slate-600">Section 3: Address</p>
                        </div>
                        
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="space-y-2 sm:col-span-2">
                                <label for="present_address" class="form-label">বর্তমান ঠিকানা</label>
                                <textarea id="present_address" name="present_address" rows="3" placeholder="বাসা/হোল্ডিং, রাস্তা, এলাকা" class="form-input"></textarea>
                            </div>
                            <div class="space-y-2 sm:col-span-2">
                                <label for="permanent_address" class="form-label">স্থায়ী ঠিকানা</label>
                                <textarea id="permanent_address" name="permanent_address" rows="3" placeholder="গ্রাম/শহর, উপজেলা, জেলা" class="form-input"></textarea>
                            </div>
                            <div class="space-y-2">
                                <label for="ward" class="form-label">ওয়ার্ড নম্বর</label>
                                <input id="ward" name="ward" placeholder="ওয়ার্ড নম্বর লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="post_office" class="form-label">ডাকঘর</label>
                                <input id="post_office" name="post_office" placeholder="ডাকঘরের নাম লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="thana" class="form-label">থানা/উপজেলা</label>
                                <input id="thana" name="thana" placeholder="থানা/উপজেলার নাম লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="district" class="form-label">জেলা</label>
                                <select id="district" name="district" class="form-input">
                                    <option value="">জেলা নির্বাচন করুন</option>
                                    <option value="dhaka">ঢাকা</option>
                                    <option value="chattogram">চট্টগ্রাম</option>
                                    <option value="rajshahi">রাজশাহী</option>
                                    <option value="khulna">খুলনা</option>
                                    <option value="barishal">বরিশাল</option>
                                    <option value="sylhet">সিলেট</option>
                                    <option value="rangpur">রংপুর</option>
                                    <option value="mymensingh">ময়মনসিংহ</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="postal_code" class="form-label">পোস্ট কোড</label>
                                <input id="postal_code" name="postal_code" placeholder="পোস্ট কোড লিখুন" class="form-input">
                            </div>
                        </div>
                        
                        <div class="flex justify-between pt-4">
                            <button type="button" class="btn-outline prev-section" data-prev="2">
                                <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                            </button>
                            <button type="button" class="btn-primary next-section" data-next="3">
                                পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </section>

                    <!-- Nominee Details Section -->
                    <section class="surface-panel p-6 sm:p-8 space-y-6 form-section hidden" data-section="4">
                        <div class="decorative-border"></div>
                        <div class="section-header">
                            <h2 class="text-xl font-bold text-slate-900">অনুচ্ছেদ ৪: মনোনীত ব্যক্তির তথ্য</h2>
                            <p class="text-sm text-slate-600">Section 4: Nominee Details</p>
                        </div>
                        
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="nominee_name" class="form-label">মনোনীত ব্যক্তির নাম</label>
                                <input id="nominee_name" name="nominee_name" placeholder="মনোনীত ব্যক্তির নাম লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="nominee_relation" class="form-label">সম্পর্ক</label>
                                <input id="nominee_relation" name="nominee_relation" placeholder="সম্পর্ক লিখুন (যেমন: পুত্র, কন্যা, স্ত্রী)" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="nominee_nid" class="form-label">মনোনীত ব্যক্তির জাতীয় পরিচয়পত্র নম্বর</label>
                                <input id="nominee_nid" name="nominee_nid" placeholder="জাতীয় পরিচয়পত্র নম্বর লিখুন" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="nominee_religion" class="form-label">মনোনীত ব্যক্তির ধর্ম</label>
                                <select id="nominee_religion" name="nominee_religion" class="form-input">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="islam">ইসলাম</option>
                                    <option value="hindu">হিন্দু</option>
                                    <option value="buddhist">বৌদ্ধ</option>
                                    <option value="christian">খ্রিস্টান</option>
                                    <option value="other">অন্যান্য</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="nominee_nationality" class="form-label">মনোনীত ব্যক্তির জাতীয়তা</label>
                                <input id="nominee_nationality" name="nominee_nationality" value="বাংলাদেশী" class="form-input">
                            </div>
                        </div>
                        
                        <div class="flex justify-between pt-4">
                            <button type="button" class="btn-outline prev-section" data-prev="3">
                                <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                            </button>
                            <button type="button" class="btn-primary next-section" data-next="4">
                                পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </section>

                    <!-- Membership Details Section -->
                    <section class="surface-panel p-6 sm:p-8 space-y-6 form-section hidden" data-section="5">
                        <div class="decorative-border"></div>
                        
                        {{-- <div class="watermark">বাংলাদেশ</div> --}}
                        
                        <div class="section-header">
                            <h2 class="text-xl font-bold text-slate-900">অনুচ্ছেদ ৫: সদস্যতার তথ্য</h2>
                            <p class="text-sm text-slate-600">Section 5: Membership Details</p>
                        </div>
                        
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="join_date" class="form-label">সদস্য ভর্তির তারিখ</label>
                                <input id="join_date" type="date" name="join_date" class="form-input">
                            </div>
                            <div class="space-y-2">
                                <label for="status" class="form-label">অবস্থা</label>
                                <select id="status" name="status" class="form-input">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="active">সক্রিয়</option>
                                    <option value="inactive">নিষ্ক্রিয়</option>
                                </select>
                            </div>
                            <div class="space-y-2 sm:col-span-2">
                                <label for="remarks" class="form-label">মন্তব্য</label>
                                <textarea id="remarks" name="remarks" rows="3" placeholder="অতিরিক্ত তথ্য (ঐচ্ছিক)" class="form-input"></textarea>
                            </div>
                            <div class="space-y-2 sm:col-span-2">
                                <label for="photo" class="form-label">সদস্যের ছবি</label>
                                <div class="file-upload">
                                    <input id="photo" type="file" name="photo" accept="image/*">
                                    <label for="photo" class="file-upload-label">
                                        <div class="text-center">
                                            <i class="fas fa-camera text-4xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600">ছবি আপলোড করতে ক্লিক করুন</p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF সর্বোচ্চ 10MB</p>
                                        </div>
                                    </label>
                                </div>
                                <img id="photoPreview" class="preview-image hidden mt-4" alt="Photo preview">
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-6">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-yellow-800">ঘোষণা</h4>
                                    <p class="text-sm text-yellow-700 mt-1">
                                        আমি ঘোষণা করছি যে, উপরে প্রদত্ত সমস্ত তথ্য সঠিক এবং সত্য। কোনো তথ্য ভুল প্রমাণিত হলে আমি যথাযথ আইনানুযায়ী শাস্তির জন্য প্রস্তুত থাকব।
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between pt-4">
                            <button type="button" class="btn-outline prev-section" data-prev="4">
                                <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                            </button>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save mr-2"></i> সদস্য সংরক্ষণ করুন
                            </button>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="flex items-center">
            <i id="toastIcon" class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
            <div>
                <p id="toastTitle" class="font-medium">সফল</p>
                <p id="toastMessage" class="text-sm text-gray-600">সদস্য সফলভাবে যোগ করা হয়েছে</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set current date and time
            const updateDateTime = () => {
                const now = new Date();
                const dateOptions = { day: 'numeric', month: 'long', year: 'numeric' };
                const timeOptions = { hour: '2-digit', minute: '2-digit' };
                
                document.getElementById('currentDate').textContent = now.toLocaleDateString('bn-BD', dateOptions);
                document.getElementById('currentTime').textContent = now.toLocaleTimeString('bn-BD', timeOptions);
            };
            
            updateDateTime();
            setInterval(updateDateTime, 60000); // Update every minute
            
            // Form navigation
            const nextButtons = document.querySelectorAll('.next-section');
            const prevButtons = document.querySelectorAll('.prev-section');
            const formSections = document.querySelectorAll('.form-section');
            const steps = document.querySelectorAll('.step');
            const progressLine = document.getElementById('progressLine');
            
            // Set current date as default for join date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('join_date').value = today;
            
            // Handle next button clicks
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentSection = parseInt(this.closest('.form-section').dataset.section);
                    const nextSection = currentSection + 1;
                    
                    if (validateSection(currentSection)) {
                        showSection(nextSection);
                        updateStepIndicator(nextSection);
                    }
                });
            });
            
            // Handle previous button clicks
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentSection = parseInt(this.closest('.form-section').dataset.section);
                    const prevSection = currentSection - 1;
                    
                    showSection(prevSection);
                    updateStepIndicator(prevSection);
                });
            });
            
            // Show specific section
            function showSection(sectionNumber) {
                formSections.forEach(section => {
                    if (parseInt(section.dataset.section) === sectionNumber) {
                        section.classList.remove('hidden');
                    } else {
                        section.classList.add('hidden');
                    }
                });
                
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
            
            // Update step indicator
            function updateStepIndicator(activeSection) {
                steps.forEach((step, index) => {
                    const stepNumber = index + 1;
                    
                    if (stepNumber < activeSection) {
                        step.classList.add('completed');
                        step.classList.remove('active');
                    } else if (stepNumber === activeSection) {
                        step.classList.add('active');
                        step.classList.remove('completed');
                    } else {
                        step.classList.remove('active', 'completed');
                    }
                });
                
                const progressPercentage = ((activeSection - 1) / (steps.length - 1)) * 100;
                progressLine.style.width = `${progressPercentage}%`;
            }
            
            // Validate section
            function validateSection(sectionNumber) {
                const currentSection = document.querySelector(`.form-section[data-section="${sectionNumber}"]`);
                const requiredFields = currentSection.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        isValid = false;
                        showToast('ত্রুটি', 'অনুগ্রহ করে সকল প্রয়োজনীয় তথ্য পূরণ করুন', 'error');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                
                return isValid;
            }
            
            // Handle form submission
            document.getElementById('memberForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!validateSection(5)) {
                    return;
                }
                
                showToast('সফল', 'সদস্য সফলভাবে নিবন্ধিত হয়েছে', 'success');
                
                setTimeout(() => {
                    this.reset();
                    showSection(1);
                    updateStepIndicator(1);
                    document.getElementById('photoPreview').classList.add('hidden');
                }, 2000);
            });
            
            // Photo preview
            document.getElementById('photo').addEventListener('change', function() {
                const file = this.files[0];
                const preview = document.getElementById('photoPreview');
                
                if (file) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };
                    
                    reader.readAsDataURL(file);
                } else {
                    preview.classList.add('hidden');
                }
            });
            
            // Toast notification function
            function showToast(title, message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastIcon = document.getElementById('toastIcon');
                const toastTitle = document.getElementById('toastTitle');
                const toastMessage = document.getElementById('toastMessage');
                
                toastTitle.textContent = title;
                toastMessage.textContent = message;
                
                toast.className = 'toast ' + type;
                
                if (type === 'success') {
                    toastIcon.className = 'fas fa-check-circle text-green-500 mr-3 text-xl';
                } else if (type === 'error') {
                    toastIcon.className = 'fas fa-exclamation-circle text-red-500 mr-3 text-xl';
                }
                
                toast.classList.add('show');
                
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
            
            // Mobile number validation for Bangladesh
            document.getElementById('mobile').addEventListener('input', function() {
                const mobilePattern = /^01[3-9]\d{8}$/;
                
                if (this.value && !mobilePattern.test(this.value)) {
                    this.setCustomValidity('অনুগ্রহ করে একটি বৈধ বাংলাদেশি মোবাইল নম্বর লিখুন');
                } else {
                    this.setCustomValidity('');
                }
            });
            
            // Add Bengali number input support
            const bengaliToEnglish = (str) => {
                const bengali = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                const english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                
                return str.replace(/[০-৯]/g, (match) => english[bengali.indexOf(match)]);
            };
            
            // Convert Bengali numbers to English on input
            document.querySelectorAll('input[type="number"], input[type="tel"]').forEach(input => {
                input.addEventListener('input', function() {
                    this.value = bengaliToEnglish(this.value);
                });
            });
        });
    </script>
</body>
</html>