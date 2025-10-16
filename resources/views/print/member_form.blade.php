<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>মিরপুর সমমনা ক্ষুদ্র ব্যবসায়ী সমবায় সমিতি লিমিটেড</title>
    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        @media print {

            html,
            body {
                background: #fff;
            }

            .page {
                box-shadow: none;
            }

            .no-print {
                display: none !important;
            }
        }

        body {
            margin: 0;
            background: #f5f5f5;
        }

        .toolbar {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 10px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: system-ui;
        }

        .toolbar a,
        .toolbar button {
            border: 1px solid #475569;
            color: #1e293b;
            background: #fff;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .toolbar button {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        .toolbar button:hover {
            background: #1d4ed8;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 0 0.8mm rgba(0, 0, 0, .15);
            padding: 14mm 14mm 12mm;
            font-family: system-ui, -apple-system, "Noto Sans Bengali", "SolaimanLipi", "Hind Siliguri", sans-serif;
            color: #111;
        }

        .head-top {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
            margin-bottom: 2mm;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #bdbdbd;
            padding-bottom: 3mm;
            margin-bottom: 4mm;
        }

        .header .title {
            margin: 0 0 1mm;
            font-size: 22px;
            font-weight: 800;
            color: #118c34;
        }

        .header .addr {
            margin: 0;
            font-size: 12.5px;
            color: #333;
        }

        .row {
            display: flex;
            gap: 8mm;
            align-items: flex-start;
            margin-top: 3mm;
            margin-bottom: 4mm;
        }

        .photo {
            width: 28mm;
            height: 34mm;
            border: 1px solid #111;
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .chips {
            display: flex;
            gap: 4mm;
            align-items: center;
            flex-wrap: wrap;
        }

        .chip {
            display: inline-block;
            padding: 2mm 5mm;
            border-radius: 3mm;
            font-weight: 700;
            color: #fff;
            font-size: 12.5px;
            line-height: 1;
        }

        .chip.green {
            background: #2e7d32;
        }

        .chip.red {
            background: #c62828;
            margin-left: 24mm;
        }

        .formno {
            margin-left: auto;
            font-size: 13px;
        }

        .member-box {
            display: inline-block;
            border: 1px solid #111;
            padding: 1.5mm 6mm;
            border-radius: 2mm;
            font-weight: 700;
            margin-top: 2mm;
            background: #fff;
        }

        .fields {
            margin-top: 2mm;
        }

        .f {
            display: flex;
            gap: 4mm;
            align-items: center;
            margin: 2.2mm 0;
            font-size: 14.5px;
        }

        /* --------- NEW dotted-line system (value floats nicely above the dots) --------- */
        .label {
            white-space: nowrap;
        }

        .dots {
            position: relative;
            flex: 1;
            min-width: 40mm;
            height: 7mm;
            /* consistent height for all lines */
            display: block;
            /* draw the dots centered vertically */
            background:
                repeating-linear-gradient(to right, transparent 0 4px, #9ca3af 4px 5px);
            background-position: left 50%;
            background-repeat: repeat-x;
            background-size: 9px 1px;
            /* spacing and dot size */
            border-bottom: 0;
            /* no real border, just the dotted bg */
        }

        .value {
            position: absolute;
            left: 0;
            right: auto;
            top: 50%;
            transform: translateY(-52%);
            /* center vertically */
            background: #fff;
            /* mask the dots under text */
            padding: 0 3mm 0 1mm;
            /* tiny breathing room */
            font-weight: 600;
            font-size: 13.5px;
            color: #0f172a;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
        }

        .pair {
            display: flex;
            gap: 6mm;
            align-items: center;
            width: 100%;
        }

        .rules-wrap {
            display: flex;
            gap: 6mm;
            align-items: flex-start;
            margin-top: 14mm;
            /* border-top: 1px solid #ececec; */
            padding-top: 4mm;
        }

        .rules {
            flex: 1;
            border: 1px solid #d84343;
            padding: 10mm 5mm 5mm;
            border-radius: 2.5mm;
            position: relative;
        }

        .rules .title {
            position: absolute;
            top: -12mm;
            left: 50%;
            transform: translateX(-50%);
            background: #d84343;
            color: #fff;
            font-weight: 800;
            padding: 1.5mm 6mm;
            border-radius: 2.5mm;
            font-size: 14px;
            letter-spacing: .2px;
        }

        .rules ol {
            margin: 0;
            padding-left: 5.5mm;
            font-size: 13.5px;
        }

        .rules li {
            margin: 1.5mm 0;
        }

        .stamp {
            width: 32mm;
            height: 40mm;
            border: 1px solid #111;
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            overflow: hidden;
        }

        .stamp img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .signs {
            margin-top: 30mm;
            display: flex;
            justify-content: space-between;
            gap: 6mm;
            text-align: center;
            font-size: 13px;
        }

        .sign {
            flex: 1;
            position: relative;
            padding-top: 4mm;
        }

        .sign::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 0;
            border-top: 1px solid #111;
            margin: 0 4mm;
        }

        .sign .cap {
            margin-top: 2mm;
            color: #333;
        }

        .bottom-rule {
            margin-top: 8mm;
            height: 0;
            border-top: 2px solid #e53935;
        }
    </style>
</head>

<body>
    <div class="toolbar no-print">
        <a href="{{ url()->previous() }}">← Back</a>
        <button onclick="window.print()">Print</button>
    </div>

    @php
        $digits = [
            '0' => '০',
            '1' => '১',
            '2' => '২',
            '3' => '৩',
            '4' => '৪',
            '5' => '৫',
            '6' => '৬',
            '7' => '৭',
            '8' => '৮',
            '9' => '৯',
        ];
        $toBn = function ($value) use ($digits) {
            if (is_null($value) || $value === '') {
                return '';
            }
            return strtr((string) $value, $digits);
        };
        $formatDate = function ($date) use ($toBn) {
            if (!$date) {
                return '';
            }
            $formatted = \Illuminate\Support\Carbon::parse($date)->format('d-m-Y');
            return $toBn($formatted);
        };

        $memberName = $member->full_name_bn ?: $member->full_name_en ?? '';
        $fatherOrSpouse = $member->father_name ?: $member->spouse_name ?? '';
        $mother = $member->mother_name ?: $member->mother_name ?? '';
        $present = $member->present_address;
        $permanent = $member->permanent_address;
        $district = $member->district;
        $mobile = $member->mobile;
        $occupation = $member->occupation;
        $institution = $member->institution_name;
        $religionValue = $member->religion;
        $nationalityValue = $member->nationality;
        $bloodGroup = $member->blood_group;
        $nomineeName = $member->nominee_name;
        $nomineeRelation = $member->nominee_relation;
        $nomineeNid = $member->nominee_nid;
        $nomineeReligion = $member->nominee_religion;
        $nomineeNationality = $member->nominee_nationality;
        $nomineePhotoPath = $member->nominee_photo_path;
        $memberNo = $member->member_no;
        $joinDate = $formatDate($member->join_date);
    @endphp

    <div class="page">
        <div class="head-top">
            <div>সঞ্চয় করুন</div>
            <div>বিসমিল্লাহির রাহমানির রাহীম</div>
            <div>ভবিষ্যৎ গড়ুন</div>
        </div>

        <div class="header">
            <h1 class="title">মিরপুর সমমনা ক্ষুদ্র ব্যবসায়ী সমবায় সমিতি লিমিটেড</h1>
            <p class="addr">মাদবর ম্যানশন (১ম তলা) বাড়ী-৫৫, এভিনিউ-১, ব্লক-বি, সেকশনঃ ১০, মিরপুর, ঢাকা-১২১৬</p>
        </div>

        <div class="row">
            <div class="photo">
                @if ($member->photo_path)
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $memberName }}" />
                @else
                    ছবি
                @endif
            </div>
            <div style="flex:1">
                {{-- <div class="chips">
          <span class="chip green">তারিখ: {{ $joinDate ?: $toBn(now()->format('d-m-Y')) }}</span>
          <span class="chip red">রেজি: নং-{{ $toBn('123456') }}</span>
          <div class="formno"><b>ফরম নংঃ</b> {{ $toBn('..............') }}</div>
        </div> --}}
                <div class="chips">
                    <span class="chip green">তারিখ: {{ $joinDate ?: $toBn(now()->format('d-m-Y')) }}</span>
                    <span class="chip red">রেজি: নং-{{ $toBn('123456') }}</span>
                    <div class="formno"><b>তারিখ</b> {{ $joinDate ?: $toBn(now()->format('d-m-Y')) }}</div>
                </div>
                <div style="margin-top:4mm">
                    <span class="member-box">সদস্য নংঃ {{ $memberNo ? $toBn($memberNo) : '........' }}</span>
                </div>
            </div>
        </div>

        <div class="fields">
            <div class="f"><span class="label">সদস্যের নাম :</span><span class="dots">
                    @if ($memberName)
                        <span class="value">{{ $memberName }}</span>
                    @endif
                </span>
            </div>
            <div class="f"><span class="label">প্রতিষ্ঠানের নাম :</span><span class="dots">
                    @if ($institution)
                        <span class="value">{{ $institution }}</span>
                    @endif
                </span>
            </div>
                <div class="f"><span class="label">পেশা :</span><span class="dots">
                    @if ($occupation)
                        <span class="value">{{ $occupation }}</span>
                    @endif
                </span>
            </div>
            <div class="f"><span class="label">পিতার/স্বামীর নাম :</span><span class="dots">
                    @if ($fatherOrSpouse)
                        <span class="value">{{ $fatherOrSpouse }}</span>
                    @endif
                </span>
            </div>
                 <div class="f"><span class="label">মাতার নাম :</span><span class="dots">
                    @if ($mother)
                        <span class="value">{{ $mother }}</span>
                    @endif
                </span>
            </div>
                       <div class="f"><span class="label">জাতীয় পরিচয় পত্র নং :</span><span class="dots">
                    @if ($member->nid_no)
                        <span class="value">{{ $toBn($member->nid_no) }}</span>
                    @endif
                </span>
            </div>
        
            <div class="f"><span class="label">বর্তমান ঠিকানা :</span><span class="dots">
                    @if ($present)
                        <span class="value">{{ $present }}</span>
                    @endif
                </span>
            </div>
            <div class="f"><span class="label">স্থায়ী ঠিকানা :</span><span class="dots">
                    @if ($permanent)
                        <span class="value">{{ $permanent }}</span>
                    @endif
                </span>
            </div>

            <div class="f pair">
                <span class="label">ধর্ম :</span>{{ $religionValue }}<span class="dots"></span>
                <span class="label">মোবাইল নং :</span><span class="dots">
                    @if ($mobile)
                        <span class="value">{{ $toBn($mobile) }}</span>
                    @endif
                </span>
            </div>

            <div class="f pair">
                 <span class="label">জাতীয়তা :</span>{{ $nationalityValue }}<span class="dots"></span>
                <span class="label">রক্তের গ্রুপ :</span>{{ $bloodGroup }}<span class="dots">
              
                </span>
            </div>
                 <div class="f pair">
                 <span class="label">নমিনির নাম :</span>{{ $nomineeName }}<span class="dots"></span>
                <span class="label">সম্পর্ক :</span>{{ $nomineeRelation }}<span class="dots">
              
                </span>
            </div>

 
            <div class="f"><span class="label">নমিনির এনআইডি/জন্ম নিবন্ধন নং :</span><span class="dots">
                    @if ($nomineeNid )
                        <span class="value">{{ $nomineeNid  }}</span>
                    @endif
                </span>
            </div>
                <div class="f pair">
                <span class="label">ধর্ম :</span>{{$nomineeReligion }}<span class="dots"></span>
                <span class="label">জাতীয়তা :</span>{{$nomineeNationality}}<span class="dots"></span>
            </div>








        </div>

        <div class="rules-wrap">
            <div class="rules">
                <div class="title">নিয়মাবলী</div>
                <ol>
                    <li>সমিতি থেকে কেউ কোন লোন বা ধার নিতে পারিবে না।</li>
                    <li>প্রতি মাসের ১০ তারিখের মধ্যে সঞ্চয়ের টাকা দিতে বাধ্য থাকিবো।</li>
                    <li>কোন সদস্যের নাম প্রত্যাহার করিতে চাইলে কার্যকরী কমিটি বরাবর আবেদন করিতে হবে।</li>
                    <li>কার্যকরী কমিটির সাথে আলোচনা সাপেক্ষে সদস্যের নাম পরিবর্তন করা যাবে।</li>
                </ol>
            </div>
            <div class="stamp">
                @if ($nomineePhotoPath)
                    <img src="{{ asset('storage/' . $nomineePhotoPath) }}" alt="{{ $nomineeName ?: $memberName }}" />
                @else
                    নমিনির ছবি
                @endif
            </div>
        </div>

        <div class="signs">
            <div class="sign">
                <div class="cap">আবেদনকারীর স্বাক্ষর</div>
            </div>
            <div class="sign">
                <div class="cap">সেক্রেটারী</div>
            </div>
            <div class="sign">
                <div class="cap">সভাপতি</div>
            </div>
        </div>

        <div class="bottom-rule"></div>
    </div>
</body>

</html>
