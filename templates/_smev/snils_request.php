<?php

$content = '<?xml version="1.0" encoding="UTF-8"?>
<s:Envelope
        xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:ns="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.1"
        xmlns:ns2="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/basic/1.1"
        xmlns:ns3="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/faults/1.1"
        xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
    <s:Body>
        <ns:SendRequestRequest>
            <ns:SenderProvidedRequestData Id="SIGNED_BY_CONSUMER" wsu:Id="SIGNED_BY_CONSUMER">
                <ns:MessageID>'.$data['MessageID'].'</ns:MessageID>
                <ns2:MessagePrimaryContent>
                    <tns:SnilsByAdditionalDataRequest xmlns:tns="http://kvs.pfr.com/snils-by-additionalData/1.0.1"
                                                      xmlns:smev="urn://x-artefacts-smev-gov-ru/supplementary/commons/1.0.1"
                                                      xmlns:pfr="http://common.kvs.pfr.com/1.0.0">
                        <smev:FamilyName>ИВАНОВ</smev:FamilyName>
                        <smev:FirstName>ИВАН</smev:FirstName>
                        <smev:Patronymic>ИВАНОВИЧ</smev:Patronymic>
                        <tns:BirthDate>1967-05-21</tns:BirthDate>
                        <tns:Gender>Male</tns:Gender>
                        <tns:BirthPlace>
                            <pfr:PlaceType>ОСОБОЕ</pfr:PlaceType>
                            <pfr:Settlement>ЗАГОРСК</pfr:Settlement>
                            <pfr:District>ЛЕНИНСКИЙ</pfr:District>
                            <pfr:Region>МОСКОВСКАЯ ОБЛАСТЬ</pfr:Region>
                            <pfr:Country>РФ</pfr:Country>
                        </tns:BirthPlace>
                        <smev:PassportRF>
                            <smev:Series>0005</smev:Series>
                            <smev:Number>777777</smev:Number>
                            <smev:IssueDate>1986-06-13</smev:IssueDate>
                            <smev:Issuer>ОВД</smev:Issuer>
                        </smev:PassportRF>
                    </tns:SnilsByAdditionalDataRequest>
                </ns2:MessagePrimaryContent>
            </ns:SenderProvidedRequestData>
            <ns:CallerInformationSystemSignature>
                <ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                    <ds:SignedInfo>
                        <ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                        <ds:SignatureMethod
                                Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256"/>
                        <ds:Reference URI="#SIGNED_BY_CONSUMER">
                            <ds:Transforms>
                                <ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                            </ds:Transforms>
                            <ds:DigestMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256"/>
                            <ds:DigestValue></ds:DigestValue>
                        </ds:Reference>
                    </ds:SignedInfo>
                    <ds:SignatureValue></ds:SignatureValue>
                    <ds:KeyInfo></ds:KeyInfo>
                </ds:Signature>
            </ns:CallerInformationSystemSignature>
        </ns:SendRequestRequest>
    </s:Body>
</s:Envelope>';