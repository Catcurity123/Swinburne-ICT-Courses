; function PAUSE
;  insert a pause by sending the CPU into busy wait
; NOTE: uses ARM processor timer register
; Arguments:
;       r0 -  BASE address of peripherals
;       r1 -  pause time (ms)
PAUSE:
        push{r0,r1,r2,r3,r4,r5,r6,r7,r8}
        mov r3,r0 ; get  Base address
        mov r4,r1  ; get pause time

        TIMER_OFFSET = $3000
        orr r3,TIMER_OFFSET ;store base address of timer (r3)

        ldrd r6,r7,[r3,#4]
        mov r5,r6 ;movstarttime (r5)(=currenttime (r6))
        timerloop:
                ldrd r6,r7,[r3,#4] ;read currenttime (r6)
                sub r8,r6,r5  ;remainingtime (8)= currenttime (r6) - starttime (r5)
                cmp  r8,r4 ;compare remainingtime (r8), delay (r4)
                bls timerloop;loop if LE (reaminingtime <= delay)
        pop{r0,r1,r2,r3,r4,r5,r6,r7,r8}
        bx lr