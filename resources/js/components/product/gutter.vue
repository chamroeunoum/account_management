<template>
  <div class="flex flex-wrap justify-around" >
    <div class="flex flex-wrap w-full h-12 border-b  font-pvh ">
      <div class="sct-transaction-date w-1/2 flex leading-10 font-dangrek text-xl">{{ sctTransactionDate }}</div>
      <div class="sct-transaction-new-package flex flex-row-reverse w-1/2">
        <div @click="toggleCreatePopup(true)" class="mx-2 w-8 h-8 mt-1 text-center hover:border-blue-300 duration-300 cursor-pointer" >
          <van-icon name="add-o" :size="32" class="hover:text-blue-600 " />
        </div>
        <!-- <div @click="$router.push('/package')" class="mx-2 ml-4 my-1 w-8 h-8 text-center hover:border-blue-300 duration-300 cursor-pointer" >
          <Icon :size="30">
            <Table />
          </Icon>
        </div> -->
        <div class="w-1/2" >
          <input type="text" @keyup.enter="getRecords()" v-model="search.value" class="bg-gray-100 px-2 h-8 my-1 w-full rounded border border-gray-200 focus:border-blue-600 hover:border-blue-600 " placeholder="ស្វែងរកឥវ៉ាន់តាមលេខកូដ" />
        </div>
        <div class="w-1/4 leading-10 text-blue-500" >
          <strong class="font-dangrek  mx-2 text-xl ">{{ totalPackages + ' ដុំ' }}</strong>
        </div>
        <div class="w-1/3 leading-10 text-blue-600" >
          <van-icon name="paid" />
          <strong class="font-dangrek mx-2 text-xl">{{ totalPrice + ' ฿' }}</strong>
        </div>
        <div class="w-1/3 leading-10 text-red-600" >
          <van-icon name="paid" />
          <strong class="font-dangrek mx-2 text-xl">{{ totalPriceUnpaid + ' ฿' }}</strong>
        </div>
        <div class="w-1/3 leading-10 text-green-600" >
          <van-icon name="paid" />
          <strong class="font-dangrek  mx-2 text-xl">{{ totalPricePaid + ' ฿' }}</strong>
        </div>
      </div>
    </div>
    <van-divider class="w-full text-2xl font-pvh" >កញ្ចប់ឥវ៉ាន់</van-divider>
    <div v-for="(record, index) in this.products.matched" :key="index" class="font-ktr w-1/6 relative flex flex-wrap text-left border border-gray-300 bg-gray-50 m-4 p-4 shadow hover:shadow-xl" >
      <div class="w-full text-xl mt-4 mb-2 font-dangrek text-blue-500" >{{ record.code }}</div>
      <!-- <div class="w-full  my-1" >
        <van-icon name="location-o" color="#1989fa"/>
        {{ record.from }}
      </div> -->
      <div class="w-full  my-1" >
        <van-icon name="location" color="#1989fa"/>
        {{ record.to }}
      </div>
      <div class="w-1/2  my-1" >
        <van-icon name="phone-o" color="#1989fa"/>
        {{ record.sender_phone }}
      </div>
      <div class="w-1/2  my-1" >
        <van-icon name="phone" color="#1989fa"/>
        {{ record.receiver_phone }}
      </div>
      <div class="w-1/2  my-1" >
        ចំនួនកញ្ចប់ ៖ {{ record.total_packages }}
      </div>
      <!-- <div class="w-1/2  my-1" >
        <van-icon name="bag-o" color="#1989fa"/>
        {{ record.weight }} គីឡូ
      </div>
      <div class="w-1/2  my-1" >
        <van-icon name="send-gift-o" color="#1989fa"/>
        {{ record.dimension }}
      </div> -->
      <div :class="'w-full  my-1 ' + ( record.payment_status == 1 ? 'text-green-600 ' : 'text-red-600 ' ) " >
        <van-icon name="paid" />
        {{ record.price }} ฿ - {{ record.payment_status == 1 ? "បង់រួច" : "មិនទាន់បង់" }}
      </div>
      <div class="w-full  mt-1 mb-1 py-2 " >
        {{ record.note }}
      </div>
      <div v-if="record.client!==undefined" title="ឈ្មោះភ្ញៀវ" class="w-1/2  mt-2 mx-auto" >
        <div class="h-16 w-full leading-10 flex flex-wrap">
          <Icon size="30" class="text-blue-500 " >
            <MdMan />
          </Icon>
          <div class="h-8 ">{{ ( record.client.lastname !== null ? record.client.lastname + " " : "" ) + ( record.client.firstname !== null ? record.client.firstname : "" ) }}</div>
        </div>
      </div>
      <div class="w-1/2  mt-2 mx-auto" >
        <qrcode-vue :value="record.to+','+record.code+','+record.sender_phone+','+record.receiver_phone" :size="60" level="H" class="mx-auto" />
      </div>
      
      <div v-if="user !== undefined && user.id == record.created_by " class="mx-2 w-4 h-4 mt-1 text-center text-red-500 cursor-pointer absolute top-1 right-1" >
        <van-icon name="close" :size="20" class="" @click="remove(record)" />
      </div>
      <div v-if="user !== undefined && user.id == record.created_by " class="mx-2 w-4 h-4 mt-1 text-center text-blue-500 cursor-pointer absolute top-1 right-8" >
        <van-icon name="edit" :size="20" class="" @click="edit(record)" />
      </div>
      <div v-if="user !== undefined && user.id == record.created_by " class="mx-2 w-4 h-4 mt-1 text-center text-yellow-500 cursor-pointer absolute top-1 right-16" >
        <icon size="20" class="" @click="showPrintReceipt(record)" >
          <Print24Regular />
        </icon>
      </div>
      
      <!-- <div class="mx-2 w-4 h-4 mt-1 text-center text-blue-500 cursor-pointer absolute top-1 right-12" >
        <van-icon name="orders-o" @click="print(record)" />
      </div> -->
      <!-- <div class="mx-2 w-4 h-4 mt-1 text-center text-blue-500 absolute left-2 top-4 " >
        <van-icon name="logistics" :size="20" class="" />
      </div>
      <div class="mx-2 w-4 h-4 mt-1 text-center text-green-500 absolute left-8 top-4 " >
        <van-icon name="passed" :size="20" class="" />
      </div> -->
    </div>
    <!-- Form create -->
    <div class="vcb-pop-create font-ktr">
      <n-modal v-model:show="createPopToggle" transform-origin="center">
        <n-card class="w-1/2 font-pvh text-xl" title="បន្ថែមបញ្ញើ" :bordered="false" size="small">
          <template #header-extra>
            <n-button type="success" @click="saveRecord()" >
              <template #icon>
                <n-icon>
                  <save />
                </n-icon>
              </template>
              រក្សារទុក
            </n-button>
          </template>
          <!-- Form create -->
          <div class="crud-create-form w-full border-t">
            <div class=" mx-auto p-4 flex-wrap">
              <div class="crud-form-panel w-full flex flex-wrap ">
                <n-form 
                  class="w-full text-left font-btb text-lg flex flex-wrap" 
                  :label-width="80"
                  :model="product.create"
                  :rules="rules"
                  size="large"
                  ref="formRef"
                >
                  <!-- <n-form-item label="ឈ្មោះសាខា" path="from" class="w-2/5 mr-8" >
                    <n-input :disabled="true" v-model:value="product.create.from" placeholder="ឈ្មោះសាខា" />
                  </n-form-item> -->
                  <n-form-item label="អតិថិជន" class="w-full" >
                    <n-select
                      v-model:value="product.create.client_id"
                      @blur="updateClientForCreation()"
                      filterable
                      clearable
                      placeholder="សូមជ្រើសរើសអតិថិជន" 
                      :options="clientfilters"
                    />
                  </n-form-item>
                  <n-form-item label="គោលដៅរបស់ឥវ៉ាន់" path="to" class="w-full" >
                    <n-input v-model:value="product.create.to" placeholder="គោលដៅរបស់ឥវ៉ាន់" />
                  </n-form-item>
                  <n-form-item label="លេខអ្នកផ្ញើ" path="sender_phone" class="w-full" >
                    <n-input v-model:value="product.create.sender_phone" placeholder="លេខអ្នកផ្ញើ" />
                  </n-form-item>
                  <n-form-item label="លេខអ្នកទទួល" path="receiver_phone" class="w-full" >
                    <n-input v-model:value="product.create.receiver_phone" placeholder="លេខអ្នកទទួល" />
                  </n-form-item>
                  <n-form-item label="តម្លៃផ្ញើ (បាត)" path="price" class="w-full" >
                    <n-input type="number" v-model:value="product.create.price" placeholder="តម្លៃផ្ញើ" />
                  </n-form-item>
                  <n-form-item label="ចំនួនកញ្ចប់" path="total_packages" class="w-full" >
                    <n-input-number type="number" :step="1" :min="1" v-model:value="product.create.total_packages" placeholder="ចំនួនកញ្ចប់" />
                  </n-form-item>
                  <n-form-item label="ប្រភេទប្រអប់" class="w-full " >
                    <n-checkbox-group
                      v-model:value="product.create.dimension"
                      name="left-size"
                      style="margin-bottom: 12px;"
                    >
                    <n-space item-style="display: flex;">
                      <n-checkbox value="20x40x60" label="20x40x60" />
                      <n-checkbox value="20x60x60" label="20x60x60" />
                      <n-checkbox value="40x40x60" label="40x40x60" />
                      <n-checkbox value="60x40x20" label="60x40x20" />
                    </n-space>
                    </n-checkbox-group>
                  </n-form-item>
                  <n-form-item label="ទំងន់ (គីឡូ)"  class="w-full" >
                    <n-input v-model:value="product.create.weight" placeholder="ទំងន់" />
                  </n-form-item>
                  <n-form-item label="ការបង់ប្រាក់" class="w-1/2" >
                    <n-radio-group
                      v-model:value="product.create.payment_status"
                      name="left-size"
                      style="margin-bottom: 12px;"
                    >
                      <n-radio-button :value="1" >បង់ទីនេះ</n-radio-button>
                      <n-radio-button :value="0">បង់ពេលដល់គោលដៅ</n-radio-button>
                    </n-radio-group>
                  </n-form-item>
                  <n-form-item label="សម្គាល់" class="w-full" >
                    <n-input 
                      type="textarea"
                      :autosize="{
                        minRows: 3,
                        maxRows: 5
                      }"
                      v-model:value="product.create.note" 
                      placeholder="សម្គាល់" />
                  </n-form-item>
                </n-form>
                <div class="w-1/2 h-8"></div>  
              </div>
            </div>
          </div>
          <!-- End form create -->
          <template #footer>
            
          </template>
        </n-card>
      </n-modal>
        
    </div>
    <!-- Form edit -->
    <div class="vcb-pop-edit font-ktr">
      <n-modal v-model:show="editPopToggle" transform-origin="center">
        <n-card class="w-1/2 font-pvh text-xl" title="កែប្រែបញ្ញើ" :bordered="false" size="small">
          <template #header-extra>
            <n-button type="success" @click="updateRecord()" >
              <template #icon>
                <n-icon>
                  <save />
                </n-icon>
              </template>
              រក្សារទុក
            </n-button>
          </template>
          <!-- Form create -->
          <div class="crud-create-form w-full border-t">
            <div class=" mx-auto p-4 flex-wrap">
              <div class="crud-form-panel w-full flex flex-wrap ">
                <n-form 
                  class="w-full text-left font-btb text-lg flex flex-wrap" 
                  :label-width="80"
                  :model="product.edit"
                  :rules="rules"
                  size="large"
                  ref="formRef"
                >
                  <!-- <n-form-item label="ឈ្មោះសាខា" path="from" class="w-2/5 mr-8" >
                    <n-input :disabled="true" v-model:value="product.edit.from" placeholder="ឈ្មោះសាខា" />
                  </n-form-item> -->
                  <n-form-item label="អតិថិជន" class="w-2/5 mr-8" >
                    <n-select
                      v-model:value="product.edit.client_id"
                      filterable
                      clearable
                      placeholder="សូមជ្រើសរើសអតិថិជន" 
                      :options="clientfilters"
                    />
                    <br/>
                  </n-form-item>
                  <n-form-item label="គោលដៅរបស់ឥវ៉ាន់" path="to" class="w-2/5 mr-8" >
                    <n-input v-model:value="product.edit.to" placeholder="គោលដៅរបស់ឥវ៉ាន់" />
                  </n-form-item>
                  <n-form-item label="លេខអ្នកផ្ញើ" path="sender_phone" class="w-2/5 mr-8" >
                    <n-input v-model:value="product.edit.sender_phone" placeholder="លេខអ្នកផ្ញើ" />
                  </n-form-item>
                  <n-form-item label="លេខអ្នកទទួល" path="receiver_phone" class="w-2/5 mr-8" >
                    <n-input v-model:value="product.edit.receiver_phone" placeholder="លេខអ្នកទទួល" />
                  </n-form-item>
                  <n-form-item label="តម្លៃផ្ញើ (បាត)" path="price" class="w-2/5 mr-8" >
                    <n-input type="number" v-model:value="product.edit.price" placeholder="តម្លៃផ្ញើ" />
                  </n-form-item>
                  <n-form-item label="ចំនួនកញ្ចប់" path="total_packages" class="w-2/5 mr-8" >
                    <n-input-number type="number" :step="1" :min="1" v-model:value="product.edit.total_packages" placeholder="ចំនួនកញ្ចប់" />
                  </n-form-item>
                  <n-form-item label="ទំងន់ (គីឡូ)"  class="w-2/5 mr-8" >
                    <n-input v-model:value="product.edit.weight" placeholder="ទំងន់" />
                  </n-form-item>
                  <n-form-item label="ការបង់ប្រាក់" class="w-2/5 mr-8" >
                    <n-radio-group
                      v-model:value="product.edit.payment_status"
                      name="left-size"
                      style="margin-bottom: 12px;"
                    >
                      <n-radio-button :value="1" >បង់ទីនេះ</n-radio-button>
                      <n-radio-button :value="0">បង់ពេលដល់គោលដៅ</n-radio-button>
                    </n-radio-group>
                  </n-form-item>
                  <n-form-item label="ប្រភេទប្រអប់" class="w-full " >
                    <n-checkbox-group
                      v-model:value="product.edit.dimension"
                      name="left-size"
                      style="margin-bottom: 12px;"
                    >
                    <n-space item-style="display: flex;">
                      <n-checkbox value="20x40x60" label="20x40x60" />
                      <n-checkbox value="20x60x60" label="20x60x60" />
                      <n-checkbox value="40x40x60" label="40x40x60" />
                      <n-checkbox value="60x40x20" label="60x40x20" />
                    </n-space>
                    </n-checkbox-group>
                  </n-form-item>
                  <n-form-item label="សម្គាល់" class="w-full" >
                    <n-input 
                      type="textarea"
                      :autosize="{
                        minRows: 3,
                        maxRows: 5
                      }"
                      v-model:value="product.edit.note" 
                      placeholder="សម្គាល់" />
                  </n-form-item>
                </n-form>
                <div class="w-1/2 h-8"></div>  
              </div>
            </div>
          </div>
          <!-- End form create -->
          <template #footer>
            
          </template>
        </n-card>
      </n-modal>
    </div>
    <!-- <teleport to="#receiptPrintArea" > -->
      <!-- KHMER VERSION -->
      <div v-if="printing.show" class="printing-dialog font-ktr fixed z-50 left-0 top-0 right-0 bottom-0 bg-white ">
        <div v-if="printing.record!==null" id="receiptPrintArea" class="relative flex flex-wrap text-left  m-4 p-4 mx-auto mt-5" style="width: 322.36px; " >
          <div class="w-full my-1 text-center" >
            <img src="./../../assets/logo.png" class=" rounded-full w-20 mx-auto" alt="SCT Logo" title="SCT Logo" />
            <div v-if="user.staff.branch_id == 1" >
              ក្រុមហ៊ុនដឹកជញ្ជូន សូនីកម្ពុជា<br/>(+៦៦) ៨៣ ២២២២ ៤៩៦ / (+៦៦) ៨៨ ៨៨៥៧ ៩៤១<br/>១៤/២-៣ ភេតបូរិ ផ្លូវ ១៣, រាចាថាវី, បាងកក ១០៤០០
            </div>
            <div v-if="user.staff.branch_id == 2" >
              ក្រុមហ៊ុនដឹកជញ្ជូន សូនីកម្ពុជា<br/>(+៦៦) ៨៣ ២២២២ ៤៩៦ / (+៦៦) ៨៨ ៨៨៥៧ ៩៤១<br/>១២០ ៤៣៣ ភេតបូរី ផ្លូវ ១៥, ឋាននផាយាថៃ, រាចាថាវី, បាងកក ១០៤០០
            </div>
          </div>
          <div class="w-1/2 mt-4 mb-2 text-left" >វិកយប័ត្រ ៖ {{printing.record.id}}</div>
          <div class="w-1/2 mt-4 mb-2 text-right" >{{ createdDate }}</div>
          <div class="w-full text-md font-bold mt-2 mb-2 text-center" >{{ printing.record.code }}</div>
          <div class="w-full  my-1" >
            <van-icon name="location-o" color="#1989fa"/>
            ចេញពី ៖ &emsp;{{ printing.record.from }}
          </div>
          <div class="w-full  my-1" >
            <van-icon name="location" color="#1989fa"/>
            ទៅកាន់ ៖ &nbsp;{{ printing.record.to }}
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="phone-o" color="#1989fa"/>
            អ្នកផ្ញើ ៖
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="phone" color="#1989fa"/>
            អ្នកទទួល ៖
          </div>
          <div class="w-1/2  my-1" >
            {{ printing.record.sender_phone }}
          </div>
          <div class="w-1/2  my-1" >
            {{ printing.record.receiver_phone }}
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="bag-o" color="#1989fa"/>
            {{ printing.record.weight }} គីឡូ
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="send-gift-o" color="#1989fa"/> {{ printing.record.total_packages }} កញ្ចប់
          </div>
          <div class="w-1/2  my-1" >
            
            {{ packageSizes }}
          </div>
          <div :class="'w-full  my-1 ' + ( printing.record.payment_status == 1 ? 'text-green-600 ' : 'text-red-600 ' ) " >
            <van-icon name="paid" />
            {{ printing.record.price }} ฿ - {{ printing.record.payment_status == 1 ? "បង់រួច" : "មិនទាន់បង" }}
          </div>
          <div class="w-full  mt-1 mb-1 py-2 " >
            {{ printing.record.note }}
          </div>
          <!-- <div v-if="printing.record.client!==undefined" title="ឈ្មោះភ្ញៀវ" class="w-1/2  mt-2 mx-auto" >
            <div class="h-16 w-full leading-10 flex flex-wrap">
              <Icon size="30" class="text-blue-500 " >
                <MdMan />
              </Icon>
              <div class="h-8 ">{{ ( printing.record.client.lastname !== null ? printing.record.client.lastname + " " : "" ) + ( printing.record.client.firstname !== null ? printing.record.client.firstname : "" ) }}</div>
            </div>
          </div> -->
          <!-- for stick on the package -->
          <div class="border-t-2 border-dashed w-full my-4 mb-8 border-gray-500"></div>
          <div class="w-full  my-1 text-center" >
            <span class="float-left leading-7">គោលដៅ ៖</span> <span class="text-2xl float-right">{{ printing.record.to }}</span>
          </div>
          <div class="w-full  my-1 leading-7" >
            អ្នកផ្ញើ ៖ <span class="text-2xl float-right">{{ printing.record.sender_phone }}</span>
          </div>
          <div class="w-full  my-1 leading-7" >
            អ្នកទទួល ៖ <span class="text-2xl float-right">{{ printing.record.receiver_phone }}</span>
          </div>
          <div class="w-full  my-1 leading-7 text-2xl text-center" >
            {{ printing.record.code }}
          </div>
          <div class="w-full  mt-2 mx-auto text-center" >
            <!-- <qrcode-vue :value="printing.record.to+','+printing.record.code+','+printing.record.total_packages+','+printing.record.sender_phone+','+printing.record.receiver_phone" :size="120" level="H" class="mx-auto my-4" /> -->
            <qrcode-vue :value="publicUrl" :size="120" level="H" class="mx-auto my-4" />
            សម្រាប់ព័ត៌មានបន្ថែម, សូមស្កេន ឃ្យូអរកូត ខាងលើ។
          </div>
          <div class="border-t-2 border-dashed w-full my-4 mt-8 border-gray-500"></div>
          <!-- end for stick on the package -->
          
          <!-- <div class="w-full  mt-12 mx-auto text-center" >
            <qrcode-vue :value="publicUrl" :size="120" level="H" class="mx-auto" />
            <br/>វិកយប័ត្រ
          </div> -->
        </div>
        <!-- printing actions -->
        <div id="buttonPrintReceipt" class="buttonPrintReceipt mx-2 w-4 h-4 mt-1 text-center text-green-500 cursor-pointer absolute top-2 right-24" @click="printReceipt()" >
          <icon size="40" class="" @click="showPrintReceipt(record)" >
            <Print24Regular />
          </icon>
        </div>
        <div id="buttonClosePrinting" class="buttonClosePrinting mx-2 w-4 h-4 mt-1 text-center text-red-500 cursor-pointer absolute top-2 right-7" @click="closePrintReceipt()">
          <van-icon name="close" :size="40" class=""  />
        </div>
        <!-- <div class="mx-2 w-4 h-4 mt-1 text-center text-yellow-500 cursor-pointer absolute top-1 right-16" >
          <icon size="20" class="" @click="showPrintReceipt(printing.record)" >
            <Print24Regular />
          </icon>
        </div> -->
      </div>
      <div v-if="false" class="printing-dialog font-ktr fixed z-50 left-0 top-0 right-0 bottom-0 bg-white ">
        <div v-if="printing.record!==null" id="receiptPrintArea" class="relative flex flex-wrap text-left  m-4 p-4 mx-auto mt-5" style="width: 322.36px; " >
          <div class="w-full my-1 text-center" >
            <img src="./../../assets/logo.png" class=" rounded-full w-20 mx-auto" alt="SCT Logo" title="SCT Logo" />
            <div v-if="user.staff.branch_id == 1" >
              SONY CAMBODIA Transportation Co,. LTD<br/>(+66) 83 2222 496 / (+66) 88 8857 941<br/>14/2-3 Phetburi Soi 13, Ratchathawi, Bangkok 10400
            </div>
            <div v-if="user.staff.branch_id == 2" >
              SONY CAMBODIA Transportation Co,. LTD<br/>(+66) 83 2222 496 / (+66) 88 8857 941<br/>120 433 Phetburi Soi 15, Thanon Phayathai, Ratchathawi, Bangkok 10400
            </div>
          </div>
          <div class="w-1/2 mt-4 mb-2 text-left" >INVOICE ៖ {{printing.record.id}}</div>
          <div class="w-1/2 mt-4 mb-2 text-right" >{{ createdDate }}</div>
          <div class="w-full text-md font-bold mt-2 mb-2 text-center" >{{ printing.record.code }}</div>
          <div class="w-full  my-1" >
            <van-icon name="location-o" color="#1989fa"/>
            FROM : &emsp;{{ "BANGKOK" }}
          </div>
          <div class="w-full  my-1" >
            <van-icon name="location" color="#1989fa"/>
            TO : &nbsp;{{ printing.record.to }}
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="phone-o" color="#1989fa"/>
            SENDER :
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="phone" color="#1989fa"/>
            RECEIVER :
          </div>
          <div class="w-1/2  my-1" >
            {{ printing.record.sender_phone }}
          </div>
          <div class="w-1/2  my-1" >
            {{ printing.record.receiver_phone }}
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="bag-o" color="#1989fa"/>
            {{ printing.record.weight }} KG
          </div>
          <div class="w-1/2  my-1" >
            <van-icon name="send-gift-o" color="#1989fa"/>
            {{ printing.record.total_packages }} Boxes
          </div>
          <div class="w-full  my-1" >
            {{ packageSizes }}
          </div>
          <div :class="'w-full  my-1 ' + ( printing.record.payment_status == 1 ? 'text-green-600 ' : 'text-red-600 ' ) " >
            <van-icon name="paid" />
            {{ printing.record.price }} ฿ - {{ printing.record.payment_status == 1 ? "PAID" : "UNPAID" }}
          </div>
          <div class="w-full  mt-1 mb-1 py-2 " >
            {{ printing.record.note }}
          </div>
          <!-- <div v-if="printing.record.client!==undefined" title="ឈ្មោះភ្ញៀវ" class="w-1/2  mt-2 mx-auto" >
            <div class="h-16 w-full leading-10 flex flex-wrap">
              <Icon size="30" class="text-blue-500 " >
                <MdMan />
              </Icon>
              <div class="h-8 ">{{ ( printing.record.client.lastname !== null ? printing.record.client.lastname + " " : "" ) + ( printing.record.client.firstname !== null ? printing.record.client.firstname : "" ) }}</div>
            </div>
          </div> -->
          <!-- for stick on the package -->
          <div class="border-t-2 border-dashed w-full my-4 mb-8 border-gray-500"></div>
          <div class="w-full  my-1 text-center" >
            <span class="float-left leading-7">TO :</span> <span class="text-2xl float-right">{{ printing.record.to }}</span>
          </div>
          <div class="w-full  my-1 leading-7" >
            SENDER : <span class="text-2xl float-right">{{ printing.record.sender_phone }}</span>
          </div>
          <div class="w-full  my-1 leading-7" >
            RECEIVER : <span class="text-2xl float-right">{{ printing.record.receiver_phone }}</span>
          </div>
          <div class="w-full  my-1 leading-7 text-2xl text-center" >
            {{ printing.record.code }}
          </div>

          <div class="w-full  mt-2 mx-auto text-center" >
          <!-- <qrcode-vue :value="printing.record.to+','+printing.record.code+','+printing.record.total_packages+','+printing.record.sender_phone+','+printing.record.receiver_phone" :size="120" level="H" class="mx-auto my-4" /> -->
          <qrcode-vue :value="publicUrl" :size="120" level="H" class="mx-auto my-4" />
            FOR MORE INFORMATION, PLEASE SCAN QRCODE.
          </div>
          
          <div class="border-t-2 border-dashed w-full my-4 mt-8 border-gray-500"></div>
          <!-- end for stick on the package -->
          
          <!-- <div class="w-full  mt-12 mx-auto text-center" >
            <qrcode-vue :value="publicUrl" :size="120" level="H" class="mx-auto" />
            <br/>វិកយប័ត្រ
          </div> -->
        </div>
        <!-- printing actions -->
        <div id="buttonPrintReceipt" class="buttonPrintReceipt mx-2 w-4 h-4 mt-1 text-center text-green-500 cursor-pointer absolute top-2 right-24" @click="printReceipt()" >
          <icon size="40" class="" @click="showPrintReceipt(record)" >
            <Print24Regular />
          </icon>
        </div>
        <div id="buttonClosePrinting" class="buttonClosePrinting mx-2 w-4 h-4 mt-1 text-center text-red-500 cursor-pointer absolute top-2 right-7" @click="closePrintReceipt()">
          <van-icon name="close" :size="40" class=""  />
        </div>
        <!-- <div class="mx-2 w-4 h-4 mt-1 text-center text-yellow-500 cursor-pointer absolute top-1 right-16" >
          <icon size="20" class="" @click="showPrintReceipt(printing.record)" >
            <Print24Regular />
          </icon>
        </div> -->
      </div>
    <!-- </teleport> -->
  </div>
</template>

<script>
import { Notify, Dialog } from 'vant'
import { Table, Save } from '@vicons/carbon'
import { Icon } from '@vicons/utils'
import { MdMan } from '@vicons/ionicons4'
import { ref, reactive, computed } from 'vue'
import { ArrowBackIosNewRound } from '@vicons/material'
import { Box16Regular, Print24Regular } from '@vicons/fluent'
import { isAuth, getUser } from './../../plugins/authentication.js'
import { useRouter } from 'vue-router'

export default {
  setup () {
    return {
      rules: {
        to: {
          required: true,
          message: 'សូមបញ្ចូលកន្លែងបញ្ជូនឥវ៉ាន់ទៅ',
          trigger: 'blur'
        },
        sender_phone: {
          required: true,
          message: 'សូមបញ្ចូលលេខទូរស័ព្ទអ្នកផ្ញើ',
          trigger: [ 'blur']
        },
        receiver_phone: {
          required: true,
          message: 'សូមបញ្ចូលលេខទូរស័ព្ទអ្នកទទួល',
          trigger: [ 'blur']
        },
        price: {
          required: true,
          message: 'សូមបញ្ចូលតម្លៃផ្ញើ',
          trigger: [ 'blur']
        }
      },
      handleValidateClick (e) {
        e.preventDefault()
        formRef.value.validate((errors) => {
          if (!errors) {
            message.success('Valid')
          } else {
            console.log(errors)
            message.error('Invalid')
          }
        })
      }
    }
  },
  components: {
    MdMan ,
    Table,
    Icon,
    Save, 
    ArrowBackIosNewRound,
    Box16Regular,
    Print24Regular
  },
  data(){
    return {
      user: null ,
      model: {
        name: 'product' ,
        title: "បញ្ញើ"
      },
      createPopToggle : false ,
      editPopToggle: false ,
      products: {
        all : [] ,
        matched : []
      } ,
      product: {
        create: {
          id: 0 ,
          client_id: null ,
          code: '' ,
          from: 'បាងកក' ,
          to: '' ,
          sender_phone: '' ,
          receiver_phone: '' ,
          weight: '' ,
          dimension: ['20x40x60'] ,
          price: '' ,
          note: '',
          payment_status: 1 ,
          total_packages: 1 
        },
        edit: {
          id: 0 ,
          client_id: null ,
          code: '' ,
          from: 'បាងកក' ,
          to: '' ,
          sender_phone: '' ,
          receiver_phone: '' ,
          weight: '' ,
          dimension: [] ,
          price: '' ,
          note: '',
          payment_status: 1 ,
          total_packages: 1 
        }
      },
      savingLoading: false ,
      editLoading: false ,
      search: {
        value: ''
      },
      client: {
        records: [] ,
        client_id: ''
      },
      printing: {
        record: null ,
        show: false,
        publicUrl: ''
      }
    }
  },
  computed:{
    packageSizes(){
      return this.printing.record.dimension.join(' ,')
    },
    totalPackages(){
      let total = 0 
      for(var i in this.products.all ){
        total += this.products.all[i].total_packages
      }
      return total
    },
    totalPrice(){
      let total = 0 
      for(var i in this.products.all ){
        total += this.products.all[i].price
      }
      return total
    },
    totalPricePaid(){
      let total = 0 
      for(var i in this.products.all ){
        total += this.products.all[i].payment_status == 1 ? this.products.all[i].price : 0 
      }
      return total
    },
    totalPriceUnpaid(){
      let total = 0 
      for(var i in this.products.all ){
        total += this.products.all[i].payment_status != 1 ? this.products.all[i].price : 0 
      }
      return total
    },
    sctTransactionDate(){
      let now = new Date()
      return now.getFullYear() + "-" + ( now.getMonth() + 1 ) + "-" + now.getDate()
    },
    createdDate(){
      let date = new Date(this.printing.record.created_at)
      return date.getUTCDate() + '/' + ( date.getUTCMonth() + 1 ) + "/" + date.getUTCFullYear() + " " + date.getUTCHours() + ":" + date.getUTCMinutes()
    },
    clientfilters(){
      // let filter = this.client.records.filter( c => 
      //   ( 
      //     ( c.firstname !== null && c.firstname.indexOf( this.client.client_id ) != -1 ) || 
      //     ( c.lastname !== null && c.lastname.indexOf( this.client.client_id ) != -1 ) ||
      //     ( c.phone !== null && c.phone.indexOf( this.client.client_id ) != -1 ) ||
      //     ( c.email !== null && c.email.indexOf( this.client.client_id ) != -1 )
      //   )
      // )
      // filter = filter.length <= 0 ? this.client.records : filter
      return this.client.records.map( ( c ) => { return {
        label: ( c.lastname !== null ? c.lastname + ' ' : '' ) +
          ( c.firstname !== null ? c.firstname + ' ' : '' ) +
          ( c.phone !== null ? c.phone + ' ' : '' ) +
          ( c.email !== null ? c.email + ' ' : '' ) ,
        value: c.id 
      } } )
    }
  },
  beforeMount(){
    if( !isAuth() ){
      router.push('/login')
    }
    this.user = getUser()
    this.getRecords()
    this.$store.dispatch('client/list').then( res => {
      switch( res.status ){
        case 200:
          this.client.records = res.data.records
        default: 
          break;
      }
    }).catch( err => console.log( err ) )
  },
  mounted(){
    
  },
  methods: {
    updateClientForCreation(){
      let client = this.client.records.find( client => client.id == this.product.create.client_id ) 
      if( client !== undefined && client !== false && client !== null ) this.product.create.sender_phone = client.phone !== "" ? client.phone : ''
    },
    printReceipt(record){
      // this.$htmlToPaper("receipt");
      window.print();
    },
    showPrintReceipt(record){
      this.printing.record = record
      this.publicUrl = window.location.origin+'/#/readpackage/'+this.printing.record.id
      console.log( this.publicUrl )
      this.printing.show = true
    },
    closePrintReceipt(){
      this.printing.show = false
      this.printing.record = null
    },
    remove(record){
      Dialog.confirm({
        title: "លុបព័ត៌មានបញ្ញើ" ,
        message: "តើអ្នកចង់លុបបញ្ញើ នេះមែនទេ?" ,
        confirmButtonText: "លុប" ,
        cancelButtonText: "ទេ"
      }).then( () => {
        /**
         * onConfirm
         */
        this.$store.dispatch('product/delete',{
          id: record.id
        }).then( res => {
          switch( res.status ){
            case 200 : 
            Notify({
              type: "success" ,
              message: "បានលុបរួចរាល់។"
            })
            this.getRecords()
            break;
          }
        }).catch( err => {
          console.log( "No" )
          Notify({
            type: "danger" ,
            message: "បរាជ័យលុបបញ្ញើ។ "
          })
        })
      }).catch( () => {
        /**
         * onCancel
         */
      })
      /**
       * Confirm before delete the package and need a reason to delete the information
       */
    },
    edit(record){
      this.product.edit = {
        id: record.id ,
        client_id: record.client_id > 0 ? record.client_id : null ,
        code: record.code ,
        from: record.from ,
        to: record.to ,
        sender_phone: record.sender_phone ,
        receiver_phone: record.receiver_phone ,
        weight: record.weight + '' ,
        dimension: record.dimension ,
        price: record.price + '',
        note: record.note,
        payment_status: record.payment_status ,
        total_packages: record.total_packages > 0 ? record.total_packages : 1
      }
      this.toggleEditPopup(true)
    },
    print(record){

    },
    updateRecord(){
      if( !this.validateData(this.product.edit) ){
        return false
      }
      // console.log( this.product.edit.client_id )
      // return false
      this.product.edit.client_id = this.product.edit.client_id > 0 ? this.product.edit.client_id : 0
      this.editLoading = true 
      this.$store.dispatch('product/update', {
        id: this.product.edit.id ,
        client_id: this.product.edit.client_id > 0 ? this.product.edit.client_id : 0 ,
        code: this.product.edit.code ,
        from: this.product.edit.from ,
        to: this.product.edit.to ,
        sender_phone: this.product.edit.sender_phone ,
        receiver_phone: this.product.edit.receiver_phone ,
        weight: this.product.edit.weight <= 0 ? 0 : this.product.edit.weight ,
        dimension: this.product.edit.dimension ,
        price: this.product.edit.price <= 0 ? 0 : this.product.edit.price ,
        note: this.product.edit.note,
        payment_status: this.product.edit.payment_status == 1 ? 1 : 0 ,
        total_packages: this.product.edit.total_packages > 0 ? this.product.edit.total_packages : 1 ,
        branch_id : this.user.staff.branch_id
      }).then( res => {
        switch( res.status ){
          case 200 : 
            this.getRecords()
            break;
          default:

            break;
        }
        this.product.edit = this.clearRecord()
        this.toggleEditPopup(false)
        this.editLoading = false 
      }).catch( err => {
        console.log( err )
        this.editLoading = false
      })
    },
    filterProducts(){
      this.products.matched = []
      for(var i in this.products.all ){
        if( this.products.all[i].code.indexOf( this.search.value ) != -1 ) {
          this.products.matched.push( this.products.all[i] )
        }
      }
      
      if( this.products.matched.length <= 0 ) {
        this.products.matched = this.products.all
      }
    },
    clearRecord(){
      return {   
        id: 0 ,
        client_id: null ,
        code: '' ,
        from: 'បាងកក' ,
        to: '' ,
        sender_phone: '' ,
        receiver_phone: '' ,
        weight: '' ,
        dimension: ['20x40x60'] ,
        price: '' ,
        note: '',
        payment_status: 1 ,
        total_packages: 1
      }
    },
    validateData(record){
      if( record.from == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបំពេញព័ត៌មានអំពីកន្លែងដាក់ផ្ញើ។'
        })
        return false
      }
      if( record.to == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបំពេញព័ត៌មានអំពីគោលដៅរបស់ឥវ៉ាន់។'
        })
        return false
      }
      if( record.sender_phone == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ចូលលេខអ្នកផ្ញើ។'
        })
        return false
      }
      if( record.receiver_phone == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ចូលលេខអ្នកទទួល។'
        })
        return false
      }
      if( record.dimension == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ជាក់អំពីទំហំនៃការវេចខ្ចប់។'
        })
        return false
      }
      if( record.price == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ជាក់អំពីតម្លៃ។'
        })
        return false
      }
      return true
    },
    toggleCreatePopup(helper) {
      this.createPopToggle = helper === true ? helper : false 
    },
    toggleEditPopup(helper) {
      this.editPopToggle = helper === true ? helper : false 
    },
    saveRecord(){
      if( !this.validateData(this.product.create) ){
        return false
      }
      
      this.savingLoading = true 
      this.$store.dispatch('product/create', {
          client_id: this.product.create.client_id > 0 ? this.product.create.client_id : 0 ,
          code: this.product.create.code ,
          from: this.product.create.from ,
          to: this.product.create.to ,
          sender_phone: this.product.create.sender_phone ,
          receiver_phone: this.product.create.receiver_phone ,
          weight: this.product.create.weight <= 0 ? 0 : this.product.create.weight ,
          dimension: this.product.create.dimension ,
          price: this.product.create.price <= 0 ? 0 : this.product.create.price ,
          note: this.product.create.note,
          payment_status: this.product.create.payment_status == 1 ? 1 : 0 ,
          total_packages: this.product.create.total_packages > 0 ? this.product.create.total_packages : 1 ,
          branch_id : this.user.staff.branch_id
        }).then( res => {
        switch( res.status ){
          case 200 : 
            this.getRecords()
            break;
          default:

            break;
        }
        this.product.create = this.clearRecord()
        this.toggleCreatePopup(false)
        this.savingLoading = false 
      }).catch( err => {
        console.log( err )
      })
      
      // .then( res => {
      //   console.log( res )
      // }).catch( err => {
      //   console.log( err )
      // })
    },
    /**
     * Get records
     */
    getRecords(){
      this.$store.dispatch('product/list',{
        // columns: table.columns.format ,
        search: {
          fields: ['sender_phone','receiver_phone','code'],
          value: this.search.value
        },
        pagination: {
          perPage: 100 ,
          page: 1
        }
      }).then(res => {
        this.$store.commit('product/setRecords',res.data.records)
        this.products.all = this.products.matched = this.$store.getters['product/getRecords'].records
      }).catch( err => {
        console.log( err )
      })
    }
  }
  
}
</script>

<style >
  @media print {
    body * {
      visibility: hidden;
    }
    #receiptPrintArea, #receiptPrintArea * {
      visibility: visible;
    }
    #receiptPrintArea {
      /* position: absolute;
      left: 0;
      top: 0; */
    }
  }
</style>