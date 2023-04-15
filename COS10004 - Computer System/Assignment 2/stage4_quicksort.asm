; function stage4_quicksort
; sorts given array using the sorting algorithm quicksort
; Arguments:
; r0 - size of array
; r1 - array to flash
; r2 - BASE address of peripherals

stage4_quicksort:
push {lr} ;call the sorting function
bl qfunction
pop {lr}

mov r0, BASE  ;flash the sorted array
mov r1, 8
adr r2, numarray2
push {lr}
bl stage2_flash_array
pop {lr}
b end1



qfunction:
qsort:
push {r0 - r10, lr}
mov r4,r1 ;address of array
mov r5,r0 ; size of array
cmp r5,#1 ;if size less than 1 done
ble qsort_done
cmp r5, #2 ;if size is 2 then compare two number
beq qsort_check


qsort_partition:
mov r1,#1
lsr r2,r5,r1 ;find the middle element index
ldr r6,[r4] ;value of the first
ldr r7,[r4,r2,lsl #2] ;value of the middle
sub r8,r5,#1 ;find the last element index
ldr r8,[r4,r8,lsl #2] ;value of the last
cmp r6,r7 ;compare and sort 3 values to find
movgt   r9,r6
movgt   r6,r7
movgt   r7,r9
cmp     r7,r8
movgt   r9,r7
movgt   r7,r8
movgt   r8,r9
cmp     r6,r7
movgt   r9,r6
movgt   r6,r7
movgt   r7,r9
mov r6,r7 ;pivot
mov r7,#0  ;index of the first element in bounds
sub r8,r5,#1 ;index of the last element in bounds

qsort_loop:
ldr r0,[r4,r7,lsl #2] ;lower value
ldr r1,[r4,r8,lsl #2] ;upper value
cmp r0,r6 ;compare lower value to pivot
beq qsort_loop_u  ;if = do nothing
addlt r7,r7,#1  ;if < move to next
strgt r0,[r4,r8,lsl #2]  ;if > swap value
strgt r1,[r4,r7,lsl #2]
subgt r8,r8,#1  ;decrease upper index
cmp r7,r8  ;if index are the same recurse
beq qsort_recurse
ldr r0,[r4,r7,lsl #2] ;lower value
ldr r1,[r4,r8,lsl #2] ;upper value

qsort_loop_u:
cmp r1,r6  ;compare upper value to pivot
subgt r8,r8,#1 ;if > decrease
strlt r0,[r4,r8,lsl #2] ;if < swap value
strlt r1,[r4,r7,lsl #2]
addlt r7,r7,#1 ;increase lower index
cmp r7,r8 ;if the same recurse
beq qsort_recurse
b qsort_loop ;continue the loop

qsort_recurse:
mov r1,r4 ;location of the first bucket
mov r0,r7 ;length of the first bucket
bl qsort ;sort the bucket
add r8,r8,#1 ;index past final index
cmp r8,r5 ;compare final index to original length
bge qsort_done ;= return
add r1,r4,r8,lsl #2 ;location of the second bucket
sub r0,r5,r8 ;length of the second bucket
bl qsort ;sort second buccket
b qsort_done ;return

qsort_check:
ldr r0, [r4] ;load first value in r0
ldr r1, [r4,#4] ;load second in r1
cmp r0,r1 
ble qsort_done ;if less than then done
str r1,[r4] ;otherwise swap
str r0,[r4,#4]

qsort_done:
pop {r0-r10,lr}
;cmp r11, #1
;beq flashend
bx lr

;flashend:
;push {r0-r2,lr}
;mov r0, BASE
;mov r1, 8
;adr r2, numarray2
;bl stage2_flash_array
;pop {r0-r2,lr}
;bx lr