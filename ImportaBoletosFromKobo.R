setwd('~/Descargas/')
a<-read.table("~/Descargas/Telegram Desktop/feb_24.csv",header=TRUE,sep=",")

##### Agrega columna de fecha y hora
a$fecha<-sub('T.*Z','',a$SubmissionDate);
a$hora<-sub('.*T','',a$SubmissionDate);a$hora<-sub('Z','',a$hora);

nal<-subset(a, a$Procedencia=='nacional');
int<-subset(a, a$Procedencia=='internacional');

fechas<-unique(a$fecha)
id=c(1:length(fechas))
extra=" 'gpo_cerrado'=>'1', 'gpo_num'=>'0', 'gpo_cgponame'=>'Recorrido_español', 'gpo_guianame'=>'Aún sin definir','gpo_notas_reg'=>'Creado desde KoboCollect e importado'"

########### Escribe archivo
sink("salida1.txt")
  for (i in 1:length(fechas)) {
    cat(paste("['gpo_id'=>'",   i,    "','gpo_date'=>'",   fechas[i],  "', 'gpo_ini_reg'=>'",   fechas[i]," 08:00:00.000', 'gpo_fin_reg'=>'",   fechas[i]," 17:00:00.000',",  extra,"],\n",sep=""))
  }
  cat('\n\n###################################################### Boletos:\n\n')
  for (i in 1:nrow(a)){
    if(a$Procedencia[i]=='nacional'){
                             cat(paste("['bol_gpoid'=>'",which(fechas==a$fecha[i]),"', 'bol_gpodate'=>'",a$fecha[i],"', 'bol_bolname'=>'Nacional',   'bol_cant'=>'",a$Total[i],"', 'bol_tipopago'=>'ef'],\n",sep=""))
      if(!is.na(a$May[i])) { cat(paste("['bol_gpoid'=>'",which(fechas==a$fecha[i]),"', 'bol_gpodate'=>'",a$fecha[i],"', 'bol_bolname'=>'Mayor60',    'bol_cant'=>'",a$May[i],  "', 'bol_tipopago'=>'ef'],\n",sep="")) }
      if(!is.na(a$Inf.[i])){ cat(paste("['bol_gpoid'=>'",which(fechas==a$fecha[i]),"', 'bol_gpodate'=>'",a$fecha[i],"', 'bol_bolname'=>'Menor13',    'bol_cant'=>'",a$Inf.[i], "', 'bol_tipopago'=>'ef'],\n",sep="")) }
      if(!is.na(a$Est[i])) { cat(paste("['bol_gpoid'=>'",which(fechas==a$fecha[i]),"', 'bol_gpodate'=>'",a$fecha[i],"', 'bol_bolname'=>'Profesor',   'bol_cant'=>'",a$Est[i],  "', 'bol_tipopago'=>'ef'],\n",sep="")) }
      if(!is.na(a$X[i]))   { cat(paste("['bol_gpoid'=>'",which(fechas==a$fecha[i]),"', 'bol_gpodate'=>'",a$fecha[i],"', 'bol_bolname'=>'Estudiante', 'bol_cant'=>'",a$X[i],    "', 'bol_tipopago'=>'ef'],\n",sep="")) }
      if(!is.na(a$Prof[i])){ cat(paste("['bol_gpoid'=>'",which(fechas==a$fecha[i]),"', 'bol_gpodate'=>'",a$fecha[i],"', 'bol_bolname'=>'Estudiante', 'bol_cant'=>'",a$Prof[i], "', 'bol_tipopago'=>'ef'],\n",sep="")) }
      
    }else{
      cat(paste("['bol_gpoid'=>'",which(fechas==a$fecha[i]),"', 'bol_gpodate'=>'",a$fecha[i],"', 'bol_bolname'=>'Internacional',   'bol_cant'=>'",sum(a[i ,c(3:8)],na.rm=T),"', 'bol_tipopago'=>'ef'],\n",sep=""))
    }
  }
sink()

