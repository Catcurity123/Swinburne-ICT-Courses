; function: FLASH
; Flashes the LED connected to GPIO18 r0 times
; Arguments:
; -  r0:  Peripheral base address
; -  r1: number of flashes
; -  r2: pause time between flashes (ms)
; -  returns nothing

FLASH:
     push{r0,r1,r2,r3,r7,r8,r9,r10}
     mov r8,r0  ; mov peripheral base address to r8 to remember it
     mov r10,r0 ; mov peripheral base address to r10 to add GPIO OFFSET
     mov r7,r1  ; mov number of flashes to r7
     mov r3,r2  ; pause time between flashes
     GPIO_OFFSET = $200000
     orr r10,GPIO_OFFSET  ; add to BASE address

     mov r9,#1
     lsl r9,#24
     str r9,[r10,#4]     ;set GPIO18 to output
     flashloop$:
        mov r9,#1
        lsl r9,#18
        str r9,[r10,#28]  ;turn LED on
       ; mov r3,$0F0000  ;not using r3 for anything else so no need to push/pop

        ; pass pause time (r0) and BASE address (r1)
        push{r0,r1}
        mov r1,r3  ; pass delay time )
        mov r0,r8      ; pass BASE address
        push{lr}
        bl PAUSE
        pop{lr}
        pop{r0,r1}

        mov r9,#1
        lsl r9,#18
        str r9,[r10,#40]  ;turn LED off
       ; mov r3,$0F0000
         ; pass pause time (r0) and BASE address (r1)
        push{r0,r1}
        mov r1,r3  ; pass delay time
        mov r0,r8  ; pass BASE ADDRESS
        push{lr}
        bl PAUSE
        pop{lr}
        pop{r0,r1}

        sub r7,#1
        cmp r7,#0
        bne  flashloop$  ;end of outer loop. Runs r7 times

     pop{r0,r1,r2,r3,r7,r8,r9,r10}    ; restore state of all registers used
     bx lr