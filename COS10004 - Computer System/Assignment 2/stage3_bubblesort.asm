; function stage3_bubblesort
; sorts numarray using the sorting algorithm bubble sort
; Arguments:
; r0 - size of array
; r1 - array to flash
; r2 - BASE address of peripherals

stage3_bubblesort:
        push {r8-r11}

        push {r0}
        loop1:
                mov r11, r1
                ldr r8, [r11], #4 ;load the value of the current index onto r8
                mov r10, #1  ;index variable
                loop2:
                        ldr r9, [r11], #4 ;load the next value onto r9
                        cmp r8, r9
                        ble swap  ;if current value is less than the next value then swap them otherwise store the
                        str r8, [r1, r10, LSL #2]  ;lsl #2 means multiply by 4 therefor we can access a memory address of an index by lsl it by 2
                        sub r10, #1                ;this code means store r8 into r1 + memory address of r10
                        str r9, [r1, r10, LSL #2]  ; similar to r8
                        add r10, #1
                        mov r9, r8
                        swap:
                        mov r8, r9
                        add r10, #1 ;move to the next index
                        cmp r10, r0 ;compare if index is reaching end
                bls loop2  ;if not reaching the end then continue the loop
                sub r0, #1 ;minus the size to end if reaching 0
                cmp r0, #0
        bgt loop1
        pop {r0}
        push {lr, r0-r2} ;pushing the preserved register for future use
                mov r8, r2 ;initialized para for flashing
                mov r9, r1
                mov r1, r0
                mov r0, r8
                mov r2, r9
                bl stage2_flash_array
        pop {lr, r0-r2}
        pop {r8-r11}
bx lr



