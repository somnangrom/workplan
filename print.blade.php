<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $show_user->present()->fullName() }}</title>  
	<link href="https://fonts.googleapis.com/css?family=Content:400,700|Moul&display=swap" rel="stylesheet"> 
  <style>
  .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        font-size: 0.8rem;
        font-family: 'Content', cursive;
 }

.invoice-headr{
        display:flex;
        flex-direction:rows;
        justify-content: space-between;  
}
.src-left{
  background-color: #cccccc;
  border-left:1px solid black;
}
.src-right{
   background-color: #cccccc;
   border-right:1px solid black;
}

.src-heading {
  background-color: #cccccc;
  border-top:1px solid black;
  border-right:1px solid black;
  border-left:1px solid black;
}

.invoice-box table tr.invoiceheading td {  
        border-bottom: 1px solid #000;
        font-weight: bold;
 }

 .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
  }
    
 .invoice-box table td {
        padding: 5px; 
 }
    
.invoice-box table tr.heading td  {  
        border-bottom: 1px solid #000;
        border-top: 1px solid #000;
        font-weight: bold;
 }

.invoice-box table tr.total td {
        border-bottom: 1px solid #000;
        border-top: 1px solid #000;
        font-weight: bold;
  }

    
.companyheading{
  margin-bottom: 0;
  text-transform: uppercase;
}

.header-subheading{
  margin:0;
}

.customername {
   text-transform: uppercase;
}


.right{
  text-align: right;
}

.invoice-summary{
  display:flex;
  justify-content:flex-end;
  margin-top:2px;
  margin-right:0px
}


.opening-balance-text{
  padding-top:20px;
}

.disclaimer-text{
  padding-top:40px;
  font-size:0.6rem;
}

  </style>
</head>
<body>
  <div class="invoice-box">
     <div  class="flex-invoicesubheader">
      <table>
            <tr class="invoiceheading" >
               <td colspan=2 >
                  <div class="invoice-headr">
                  <div  class="headerdiv">
						@if ($snipeSettings->logo_print_assets=='1')
							@if ($snipeSettings->brand == '3')

								<h2 class="companyheading">
								@if ($snipeSettings->logo!='')
									<img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
								@endif
								{{ $snipeSettings->site_name }}
								</h2>
							@elseif ($snipeSettings->brand == '2')
								@if ($snipeSettings->logo!='')
									<img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
								@endif
							@else
							  <h2 class="companyheading">{{ $snipeSettings->site_name }}</h2>
							@endif
						@endif
                  </div>
                  <div  class="headerinvoicediv">
                     <h2  class="companyheading"> NO #OTO-9171</h2>
                     <h3  class="header-subheading">16 May, 2019</h3>
                  </div>
                 </div>
               </td>
            </tr>
            <tr>
               <td  style="padding-top: 15px; vertical-align: top;">
                  <div  class="headerdiv-customer">
                     <div  class="sub-customerinfo"><b >Bill To</b></div>
                     <div  class="customername">{{ $show_user->present()->fullName() }}</div>
                     <div  class="sub-customerinfo">{{ $show_user->present()->phone() }}</div>
                     <div  class="sub-customerinfo">Houston TX</div>
                     <div  class="sub-customerinfo">77099 </div>
                  </div>
               </td>
               <td  style="padding-top: 15px; vertical-align: top;">             
                  <div  class="ng-star-inserted">
                     <div  class="date ng-star-inserted" style="text-align: right;"><b >Invoice By</b></div>
                     <div  class="date" style="text-align: right;">ANIS</div>
                  </div>
                  <div >
                     <div  class="date" style="text-align: right;"><b >Total Amount</b></div>
                     <div  class="date" style="text-align: right;">$44.00</div>
                  </div>
               </td>
            </tr>
      </table>
   </div>
   <div>
@if ($assets->count() > 0)
    @php
        $counter = 1;
    @endphp
       <table cellpadding="0" cellspacing="0"> 
		
         <tr >
                <td>

                </td>  
                <td>
  
                </td>
                <td>
     
                </td>
                <td>
         
                </td>
                <td  class="right">
               
                </td>
                <td colspan="2" class="src-heading" style="text-align:center; "  >
                    RETAIL INFORMATION
                </td>
             
            </tr>
            <tr class="heading">
                <td>
                   No
                </td>  
                <td>
                    Asset Tag
                </td>
                <td>
                    Name
                </td>
                <td class="right">
                    Category
                </td>
                <td  class="right">
                    Model
                </td>
                <td  class="right src-left">
                    Serial
                </td>
               <td  class="right src-right">
                    Check Out
                </td>
            </tr>
            @foreach ($assets as $asset)
				<tr class="item">
					<td>{{ $counter }}</td>
					<td>{{ $asset->asset_tag }}</td>
					<td>{{ $asset->name }}</td>
					<td>{{ $asset->model->category->name }}</td>
					<td>{{ $asset->model->name }}</td>
					<td>{{ $asset->serial }}</td>
					<td>{{ $asset->last_checkout }}</td>
				</tr> 
				@php
					$counter++
				@endphp
			@endforeach
            
        </table>
@endif
@if ($consumables->count() > 0)
    <br><br>
    <table class="inventory">
        <thead>
        <tr>
            <th colspan="4">{{ trans('general.consumables') }}</th>
        </tr>
        </thead>
        <thead>
        <tr>
            <th style="width: 20px;"></th>
            <th style="width: 40%;">Name</th>
            <th style="width: 50%;">Category</th>
            <th style="width: 10%;">Checked Out</th>
        </tr>
        </thead>
        @php
            $ccounter = 1;
        @endphp

        @foreach ($consumables as $consumable)

            <tr>
                <td>{{ $ccounter }}</td>
                <td>{{ ($consumable->manufacturer) ? $consumable->manufacturer->name : '' }}  {{ $consumable->name }} {{ $consumable->model_number }}</td>
                <td>{{ $consumable->category->name }}</td>
                <td>{{  $consumable->assetlog->first()->created_at }}</td>
            </tr>
            @php
                $ccounter++
            @endphp
        @endforeach
    </table>
@endif
    </div>
    
    <div class="flex-invoicesubheader">
      <table>
        <tbody >
          
            <tr >
               <p  class="disclaimer-text"> ១.បុគ្គលិកត្រូវមើលថែឱ្យបានល្អនិងបើមានការបាត់ខូចខាតបុគ្គលិកជាអ្នកទទួលខុសត្រូវរាល់
សម្ភារៈដោយខ្លួនឯងលើកលែងតែកំហុសកើតឡើងពីការងារ។
២.ពេលយកមកប្រគល់ឱ្យក្រុមហ៊ុនវិញត្រូវភ្ជាប់មកជាមួយលិខិតនឹងសម្ភារៈទាំងអស់មកជាមួយវិញផងមិន
ថាសម្ភារៈនោះខូចខាតក៏ដោយ។
				</p>
            </tr>
         </tbody>
      </table>
   </div>
   </div>
</body>
</html>
